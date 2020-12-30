import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';
import 'package:flutter_webview_plugin/flutter_webview_plugin.dart';

import 'package:webview_flutter/webview_flutter.dart';
import 'dart:async';


class Panel extends StatefulWidget {
  @override
  _PanelState createState() => _PanelState();
}

class _PanelState extends State<Panel> {
  Future<void> computeFuture = Future.value();

  InAppWebViewController _webViewController;
  String url = "";
  double progress = 0;

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Column(
        mainAxisSize: MainAxisSize.max,
        children: [
          AppBar(title:const Text("IsimLink - Admin Panel"),),
          Container(
            alignment: Alignment.topCenter,
            child: Column(
              children: [
              Container(
                alignment: Alignment.topCenter,
              height: MediaQuery.of(context).size.height-AppBar().preferredSize.height-MediaQuery.of(context).padding.top-MediaQuery.of(context).padding.bottom-74,
              child:
              InAppWebView(
                initialUrl: "https://isim.link/login.php",
                initialOptions: InAppWebViewGroupOptions(
                    crossPlatform: InAppWebViewOptions(
                      debuggingEnabled: true,
                    )
                ),
                onWebViewCreated: (InAppWebViewController controller) {
                  Scaffold.of(context).showSnackBar(SnackBar(content: Text('Panele her girişinizde doğrulama yapmalısınız.')));
                  _webViewController = controller;
                },
                onLoadStart: (InAppWebViewController controller, String url) {
                  setState(() {
                    this.url = url;
                  });
                },
                onLoadStop: (InAppWebViewController controller, String url) async {
                  setState(() {
                    this.url = url;
                  });
                },
                onProgressChanged: (InAppWebViewController controller, int progress) {
                  setState(() {
                    this.progress = progress / 100;
                  });
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


