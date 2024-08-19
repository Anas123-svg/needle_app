import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:needle_project/main.dart';
import 'package:needle_project/screens/Client_Screen/client_screen.dart';
import 'package:needle_project/screens/portfolio_screen/portfolio_screen.dart';
import 'package:needle_project/screens/profile_screen/profile_screen.dart';
import 'package:needle_project/screens/session_screen/session_screen.dart';
import 'package:needle_project/screens/home_screen/home_screen.dart';

class MainscreenController extends GetxController {
  var selectedIndex = 0.obs;

  List<Widget> screens = [
    HomeScreen(),
    SessionScreen(),
    ClientScreen(),
    PortfolioScreen(),
    ProfileScreen(),
  ];

  void onItemTapped(int index) {
    selectedIndex.value = index;
  }
}
