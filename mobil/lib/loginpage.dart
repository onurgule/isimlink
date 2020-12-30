import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';
import 'package:provider/provider.dart';
import 'package:isimlink/models/UserModel.dart';
class LoginPage extends StatefulWidget {
  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage>
    with SingleTickerProviderStateMixin {
  AnimationController _controller;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(vsync: this);
  }

  void loginApp(BuildContext context,Map<String,dynamic> user) {
    Provider.of<UserModel>(context, listen: false).login(user);
  }
  @override
  void dispose() {
    super.dispose();
    _controller.dispose();
  }
  String url = "";
  double progress = 0;
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Column(
        mainAxisSize: MainAxisSize.max,
        children: [
          AppBar(title:const Text("IsimLink - Giriş"),),
          Container(
            alignment: Alignment.topCenter,
            child: Column(
              children: [
              Container(
                alignment: Alignment.topCenter,
              height: MediaQuery.of(context).size.height-AppBar().preferredSize.height-MediaQuery.of(context).padding.top-MediaQuery.of(context).padding.bottom-74,
              child:
              InAppWebView(
                initialUrl: "https://isim.link/login.php?mobile=true",
                initialOptions: InAppWebViewGroupOptions(
                    crossPlatform: InAppWebViewOptions(
                      debuggingEnabled: true,
                    )
                ),
                onLoadStop: (InAppWebViewController controller, String url) async {
                  if(url.contains("getDetails.php")){
                 // controller.stopLoading();
                 String details = await controller.getHtml();
                 String toJson = (details.split('body>')[1].replaceAll('</', ''));
                 Map<String,dynamic> user = jsonDecode(toJson);
                 print(user['domain']);
                 loginApp(context, user);
                  Navigator.pop(context);
                  }
                },
              ),
              ),
              ],
            ),
          ),

        ],
      ),
    );
  }
}