import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';
import 'package:isimlink/LinkDetails.dart';
import 'package:provider/provider.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:isimlink/models/UserModel.dart';
import 'package:isimlink/loginpage.dart';
import 'dart:convert';
import 'package:isimlink/models/Link.dart';
import 'package:http/http.dart' as http;

class Homepage extends StatefulWidget {

  @override
  _HomepageState createState() => _HomepageState();
}

class _HomepageState extends State<Homepage> {
  
  @override
  Widget build(context) {
   Provider.of<UserModel>(context, listen: false).getUser();
    return
      Scaffold(
        drawer: Drawer(
        // Add a ListView to the drawer. This ensures the user can scroll
        // through the options in the drawer if there isn't enough vertical
        // space to fit everything.
        child: ListView(
          // Important: Remove any padding from the ListView.
          padding: EdgeInsets.zero,
          children: <Widget>[
            Container(
              height: 150,
              child: DrawerHeader( 
                child: 
                ListView(children: [
                DefaultTextStyle(
                  child: Text("IsimLink"),
                  style: TextStyle(
                    fontSize: 25
                  ),
                ),
                (Provider.of<UserModel>(context).uid != null && Provider.of<UserModel>(context).uid != "0") ? 
                DefaultTextStyle(
                  child: Text(Provider.of<UserModel>(context).domain+".isim.link"),
                  style: TextStyle(
                    color: Colors.white
                  ),
                )
                :  
                OutlineButton(
                  
                  onPressed: () {
                    Future.delayed(Duration.zero, () {
                     Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => LoginPage()),
                    );
                    });
                  },
                  textColor: Colors.white,
                  child: Text('Giriş Yap'),
                ),
                Container(
              child: Column(children: [ Image(image: NetworkImage('https://isim.link/assets/images/logos/logo_transparent.png'), width: 50, height: 50)],),
            ),
                ],)
                ,
                decoration: BoxDecoration(
                  color: Colors.blue,
                  
                ),
              ),
            ),
            ListTile(
              title: Text('Ara'),
              onTap: () {
                Navigator.pop(context);
              },
            ),
            ListTile(
              title: Text('Panel'),
              onTap: () {
                DefaultTabController.of(context).animateTo(1);
                Navigator.pop(context);
              },
            ),
            (Provider.of<UserModel>(context).uid != null && Provider.of<UserModel>(context).uid != "0" )?
            ListTile(
              title: Text('Çıkış'),
              onTap: () {
                Provider.of<UserModel>(context, listen:false).logout();
                Navigator.pop(context);
              },
            ) : Container(),
            Spacer(),
            Container(
              child: Align(
                alignment: Alignment.bottomCenter,
                child: Text('IsimLink © 2020 '),
              ),
            ),
          ],
        ),
        ),
        appBar: AppBar(
          title: Text('IsimLink'),
        ),
        body:SafeArea(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: Text(
                  'IsimLink\'te Arayın',
                  style: Theme.of(context).textTheme.headline6,
                ),
              ),
              MyCustomForm(),
              //burada arama sonuçları olacak
            ],
          ),
        ),
      );
  }
}

// Create a Form widget.
class MyCustomForm extends StatefulWidget {
  @override
  MyCustomFormState createState() {
    return MyCustomFormState();
  }
}

class MyCustomFormState extends State<MyCustomForm> {
  // Create a global key that uniquely identifies the Form widget
  // and allows validation of the form.
  //
  // Note: This is a GlobalKey<FormState>,
  // not a GlobalKey<MyCustomFormState>.
  @override
 void initState() {
 _controller = ScrollController();
 _controller.addListener(_scrollListener);//the listener for up and down. 
 super.initState();
}
_scrollListener() {
  if (_controller.offset >= _controller.position.maxScrollExtent &&
     !_controller.position.outOfRange) {
   setState(() {//you can do anything here
   });
 }
 if (_controller.offset <= _controller.position.minScrollExtent &&
    !_controller.position.outOfRange) {
   setState(() {//you can do anything here
    });
  }
}
  final _formKey = GlobalKey<FormState>();
  InAppWebViewController webView;
  String keyword = '';
  List<Link> searches = new List<Link>();
 ScrollController _controller;
Future<List<Link>> fetchLink(String keyword) async {
  searches.clear();
  final response = await http.get('https://isim.link/api/search_json.php?query='+keyword);
  if (response.statusCode == 200) {
    for (var link in jsonDecode(response.body)) {
      print(link);
      searches.add(Link.fromJson(link));
    }
    return searches;
  } else {
    throw Exception('Failed to search.');
  }
}

  doSearch() async{
    //webView.loadUrl(url: "https://isim.link/api/search.php?a=s&query="+keyword);
    List<Link> links = await fetchLink(keyword);
    links.map((e) => {
     print(e.toString())
    });
    setState(() {
      
    });
  }
  @override
  Widget build(BuildContext context) {
    // Build a Form widget using the _formKey created above.
    return Form(
      key: _formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Center(
            child: Container(
              width: MediaQuery.of(context).size.width * 0.85,
              child: TextFormField(
                cursorColor: Colors.blueAccent,
                decoration: new InputDecoration(
                  hintText: "Anahtar kelime giriniz...",
                  labelText:"Ara",
                  alignLabelWithHint: true,
                  border: new UnderlineInputBorder(
                    
                    borderSide: new BorderSide(
                      color: Colors.blueAccent
                    )
                  )
                ),
                onChanged: (String value){
                  keyword = value;

                },

                textAlign: TextAlign.center,
                validator: (value) {
                  if (value.isEmpty) {
                    return 'Aramak istediğiniz kişiyi giriniz';
                  }
                  return null;
                },
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 16.0, horizontal: 150),
            child: Container(
              width: 250,
              child: ElevatedButton(
                onPressed: () {
                  if (_formKey.currentState.validate()) {
                    //Scaffold.of(context).showSnackBar(SnackBar(content: Text('Aranıyor')));
                    doSearch();
                  }
                },
                child: Column(
                  children: [
                    Text('Ara')
                  ],
                )
              ),
            ),
          ),
      Container(
        height: 200,
        child: ListView.separated(
  padding: const EdgeInsets.all(8),
  controller: _controller,
  itemCount: searches.length,
  itemBuilder: (BuildContext context, int index) {
    return GestureDetector(
      onTap: (){
        print('${searches[index].getDomain()}');
        Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => LinkDetails(myLink:searches[index])),
                    );
      },
          child: Container(
        height: 50,
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(20),
          color: Colors.lightBlue
          ),
        child: Center(child: Text('${searches[index].getDomain()}.isim.link')),
      ),
    );
  },
  separatorBuilder: (BuildContext context, int index) => const Divider(),
),
      )

        ],
      ),
    );
  }
}
