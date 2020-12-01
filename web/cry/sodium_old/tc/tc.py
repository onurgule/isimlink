import json
import sys

def numero(numb):
    if len(str(numb)) > 0:
        return int(numb)
    else:
        return 0

def tcno_checksum(tcno):
    if len(str(tcno)) == 9:
        tc    = '%d' % tcno
        tc10  = numero(tc[0]) + numero(tc[2]) + numero(tc[4]) + numero(tc[6]) + numero(tc[8])
        tc10 *= 7
        tc10 -= numero(tc[1]) + numero(tc[3]) + numero(tc[5]) + numero(tc[7])
        tc10 %= 10
        tc11  = numero(tc[0]) + numero(tc[1]) + numero(tc[2]) + numero(tc[3]) + numero(tc[4])
        tc11 += numero(tc[5]) + numero(tc[6]) + numero(tc[7]) + numero(tc[8]) + numero(tc10)
        tc11 %= 10
        return '%s%d%d' % (tc, tc10, tc11)
    else:
        return 0

def akraba_tcno(tcno, adet):
    akrabas = []
    tc   = numero(tcno[0:-2])
    t    = tc - 29999 * (1 + numero(adet / 2))
    for i in range(adet+1):
        t += 29999
        atc = tcno_checksum(t)
        if atc == tcno:
            pass
        else:
            akrabas.append(atc)
    return akrabas
def onbinlik(tcno1,tcno2):
    try:
        listim = akraba_tcno(str(tcno1),numero(10000)).index(tcno2)
        return("1" if listim>-1 else "0")
    except:
        return("0")

tcno1 = sys.argv[1]
okey = "0"
tcno2 = sys.argv[2]
filter = sys.argv[3]
kactane = (10000 if (int(filter)/10000)<1 else int(filter)/10000)
for i in xrange(0,kactane):
    if(onbinlik(tcno1,tcno2)=="1"):
        okey = "1"
        break
    else:
        tcno1 = tcno2
print(okey)