import json
import sys

def tcno_checksum(tcno):
    if len(str(tcno)) == 9:
        tc    = '%d' % tcno
        tc10  = int(tc[0]) + int(tc[2]) + int(tc[4]) + int(tc[6]) + int(tc[8])
        tc10 *= 7
        tc10 -= int(tc[1]) + int(tc[3]) + int(tc[5]) + int(tc[7])
        tc10 %= 10
        tc11  = int(tc[0]) + int(tc[1]) + int(tc[2]) + int(tc[3]) + int(tc[4])
        tc11 += int(tc[5]) + int(tc[6]) + int(tc[7]) + int(tc[8]) + int(tc10)
        tc11 %= 10
        return '%s%d%d' % (tc, tc10, tc11)
    else:
        return 0

def akraba_tcno(tcno, adet):
    akrabas = []
    tc   = int(tcno[0:-2])
    t    = tc - 29999 * (1 + int(adet / 2))
    for i in range(adet+1):
        t += 29999
        atc = tcno_checksum(t)
        if atc == tcno:
            pass
        else:
            akrabas.append(atc)
    return akrabas
try:
    tcno1 = sys.argv[1]
    tcno2 = sys.argv[2]
    filter = sys.argv[3]
    listim = akraba_tcno(str(tcno1),int(filter)).index(tcno2)
    print("1" if listim>-1 else "c")
except:
    print("0")