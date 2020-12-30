import 'package:flutter/material.dart';

import 'homepage.dart';
import 'panel.dart';
import 'package:provider/provider.dart';
import 'package:isimlink/models/UserModel.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  runApp(
    MaterialApp(
      home: HomePage(),
    ),
  );
}

class HomePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider.value(
          value: UserModel(),
        ),
      ],
      child: MaterialApp(
      home: DefaultTabController(
        length: 2,
        child: Scaffold(
          bottomNavigationBar: menu(),
          body: TabBarView(
            children: [
              Homepage(),
              Panel(),
            ],
          ),
        ),
      ),
    ),
    );
  }


Widget menu() {
  return Container(
    color: Color(0xFF3F5AA6),
    child: TabBar(
      labelColor: Colors.white,
      unselectedLabelColor: Colors.white70,
      indicatorSize: TabBarIndicatorSize.tab,
      indicatorPadding: EdgeInsets.all(5.0),
      indicatorColor: Colors.blue,
      tabs: [
        Tab(
          icon: Icon(Icons.search),
          text: 'Arama',
        ),
        Tab(
          icon: Icon(Icons.flash_on),
          text: 'Panel',
        )
      ],
    ),
  );
}

}

