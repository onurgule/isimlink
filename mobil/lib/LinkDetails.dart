import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:isimlink/models/Link.dart';
import 'package:share/share.dart';

import 'package:provider/provider.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:isimlink/models/UserModel.dart';
import 'package:http/http.dart' as http;
import 'package:isimlink/loginpage.dart';
class LinkDetails extends StatefulWidget {
  final Link myLink;
  List myInfos = new List();
  LinkDetails({this.myLink});

  @override
  _LinkDetailsState createState() => _LinkDetailsState();
}

class _LinkDetailsState extends State<LinkDetails> {
   @override
  void initState() {
    super.initState();
    getDomainInfos();
   
  }

void getDomainInfos()async{
             final response = await http.get('https://isim.link/api/getLinkDetails.php?uid='+Provider.of<UserModel>(context, listen: false).uid+"&query="+widget.myLink.getDomain());
  if (response.statusCode == 200) {
    for (var info in jsonDecode(response.body)) {
      print(info);
      widget.myInfos.add(info);
      print(widget.myInfos.toString());
      setState(() {});
    }
  }
}
String getType(String type){
switch(type){
  case '-2': return "Soyad";
  case '-1': return "Ad";
  case '1': return "Email";
  case '2': return "Telefon";
}

}
String getDomainSuffix(BuildContext context){
  print(context);
 if(Provider.of<UserModel>(context, listen: false).uid == "0")
 Future.delayed(Duration.zero, () async {
  Scaffold.of(context).showSnackBar(SnackBar(content: Text('Giriş yaparak daha fazla bilgi görebilirsiniz.'),action: SnackBarAction(label: "Giriş", onPressed: (){
      
      Navigator.pop(context);
      Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => LoginPage(), settings: RouteSettings()),
                    );
    }),));
});
    
  return '.isim.link';
}
String getPreferredPhone(){
  String val = "";
  for (var item in widget.myInfos) {
    if(item['Type'] == '2') val = item['Info'];
  }
  
    
  return val;
}
String getPreferredEmail(){
  String val = "";
  for (var item in widget.myInfos) {
    if(item['Type'] == '1') val = item['Info'];
  }
  return val;
}

  @override
  Widget build(BuildContext context) {
    
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.myLink.getDomain()+".isim.link"),
        
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: ()async {
          //Provider.of<UserModel>(context, listen: false).uid
         // getDomainInfos();
            Share.share("https://"+widget.myLink.getDomain()+".isim.link");
        },
        child:Icon(Icons.share),
        backgroundColor: Colors.lightBlue,
      ),
        body: Builder(
          builder: (BuildContext innerContext){
          return ListView(
            children: <Widget>[
              Container(
                height: 250,
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    colors: [Colors.blueGrey, Colors.lightBlue.shade300],
                    begin: Alignment.centerLeft,
                    end: Alignment.centerRight,
                    stops: [0.5, 0.9],
                  ),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceAround,
                      children: <Widget>[
                        getPreferredPhone() != "" ?
                        GestureDetector(
                          onTap: (){
                            launch("tel://"+getPreferredPhone());
                          },
                            child: CircleAvatar(
                            backgroundColor: Colors.lightBlue.shade300,
                            minRadius: 35.0,
                            child: Icon(
                              Icons.call,
                              size: 30.0,
                            ),
                          ),
                        )
                        :
                        Column()
                        ,
                        CircleAvatar(
                          backgroundColor: Colors.white70,
                          minRadius: 60.0,
                          child: CircleAvatar(
                            radius: 50.0,
                            backgroundImage:
                                NetworkImage('https://media-s3-us-east-1.ceros.com/lee/images/2020/03/13/526652c2552319459bf6d52c8c3eb77f/covidweb-05-mask.png'),
                          ),
                        ),
                        getPreferredPhone() != "" ?
                         GestureDetector(
                           onTap: (){
                             launch("https://wa.me/${getPreferredPhone()}");
                           },
                                                  child: CircleAvatar(
                            backgroundColor: Colors.lightBlue.shade300,
                            minRadius: 35.0,
                            child: FaIcon(FontAwesomeIcons.whatsapp,                          size: 30.0,
                            ),
                        ),
                         )
                        :
                        getPreferredEmail() != "" ?
                        GestureDetector(
                          onTap: (){
                            launch("mailto:${getPreferredEmail()}");
                          },
                                                  child: CircleAvatar(
                            backgroundColor: Colors.lightBlue.shade300,
                            minRadius: 35.0,
                            child: Icon(
                              Icons.email,
                              size: 30.0,
                            ),
                          ),
                        )
                        :
                        Column(),
                      ],
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    Text(
                      widget.myLink.getName(),
                      style: TextStyle(
                        fontSize: 35,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    Text(
                      widget.myLink.getDomain()+getDomainSuffix(innerContext),
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 25,
                      ),
                    ),
                  ],
                ),
              ),
              Container(
                child: Column(
                  children: [
                    for (var info in widget.myInfos) 
                      Column(
                        children: [
                          GestureDetector(
                            onTap: (){
                              switch(info['Type']){
                                case "1":
                                launch('mailto:${info['Info']}');
                                break;
                                case "2":
                                launch('tel://${info['Info']}');
                                break;
                              }
                            },
                          child: ListTile(
                            title: Text(
                              getType(info['Type']),
                              style: TextStyle(
                                color: Colors.deepOrange,
                                fontSize: 20,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            subtitle: Text(
                              info['Info'],
                              style: TextStyle(
                                fontSize: 18,
                              ),
                            ),
                          ),
                    ),
                    Divider(),
                        ],
                      ),
                    
                  ]
                ),
              )
            ],
          );
          }
        ),
    );
  }
}