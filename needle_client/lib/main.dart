import 'package:device_preview/device_preview.dart';
import 'package:flutter/material.dart';
import 'package:get/get_navigation/src/root/get_material_app.dart';
import 'package:needle_project/screens/Login_screen/login_screen.dart';
import 'package:needle_project/screens/main_screen/main_Screen.dart';
import 'package:needle_project/screens/splashscreen/splashscreen.dart';

void main() {
  runApp(HomePage());
  // runApp(
  //   DevicePreview(
  //     enabled: true,
  //     builder: (context) => HomePage(), // Wrap your app
  //   ),
  // );
}

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      home: MainScreen(),
    );
  }
}
