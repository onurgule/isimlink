import 'dart:convert';

import 'package:flutter/foundation.dart';
import 'package:shared_preferences/shared_preferences.dart';

class UserModel extends ChangeNotifier {
    String domain = "";
    String uid = "0";
    String name = "";
    String surname = "";
    
    void login(Map<String,dynamic> user) {
        this.uid = user['uid'];
        this.domain = user['domain'];
        this.name = user['name'];
        this.surname = user['surname'];
        saveUser();
        notifyListeners();
    }
    void logout(){
        this.uid = "0";
        this.domain = "";
        this.name = "";
        this.surname = "";
        deleteUser();
        notifyListeners();
    }
    void saveUser() async{
      SharedPreferences prefs = await SharedPreferences.getInstance();
      prefs.setString('uid', this.uid);
      prefs.setString('domain', this.domain);
      prefs.setString('name', this.name);
      prefs.setString('surname', this.surname);
    }
    void getUser() async{
      SharedPreferences prefs = await SharedPreferences.getInstance();
      if(prefs.getKeys().contains('uid')){
      this.uid = prefs.getString('uid');
      this.domain = prefs.getString('domain');
      this.name = prefs.getString('name');
      this.surname = prefs.getString('surname');
      notifyListeners();
      }
    }
    void deleteUser() async{
      SharedPreferences prefs = await SharedPreferences.getInstance();
      prefs.remove('uid');
      prefs.remove('domain');
      prefs.remove('name');
      prefs.remove('surname');
    }
}