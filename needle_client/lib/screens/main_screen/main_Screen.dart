import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/main_screen/mainscreen_controller.dart';
import 'package:needle_project/utils/Colors.dart';

class MainScreen extends StatefulWidget {
  const MainScreen({super.key});

  @override
  State<MainScreen> createState() => _MainScreenState();
}

class _MainScreenState extends State<MainScreen> {
  @override
  Widget build(BuildContext context) {
    double h = MediaQuery.of(context).size.height;
    double w = MediaQuery.of(context).size.width;
    final MainscreenController navController = Get.put(MainscreenController());

    return Scaffold(
      backgroundColor: AppColors.whiteColor,
      body: Obx(() => navController.screens[navController.selectedIndex.value]),
      drawer: Drawer(),
      appBar: AppBar(
        backgroundColor: AppColors.whiteColor,
        actions: [
          Container(
            margin: EdgeInsets.only(right: 15),
            height: h * 0.15,
            width: w * 0.15,
            decoration: BoxDecoration(
                image: DecorationImage(
                    image: AssetImage('assets/images/profilePic.png'))),
          )
        ],
        centerTitle: true,
        title: Column(
          children: [
            Text(
              'Michkael Rivard',
              style: GoogleFonts.montserrat(
                  color: AppColors.richGreen,
                  fontWeight: FontWeight.w700,
                  fontSize: 17),
            ),
            Text(
              'Copy portfolio url to clipboard',
              style: GoogleFonts.montserrat(
                  color: Colors.black,
                  fontWeight: FontWeight.w700,
                  fontSize: 13),
            )
          ],
        ),
      ),
      bottomNavigationBar: Obx(
        () => CustomBottomNavBar(
          selectedIndex: navController.selectedIndex.value,
          onTap: navController.onItemTapped,
        ),
      ),
    );
  }
}

class CustomBottomNavBar extends StatelessWidget {
  final int selectedIndex;
  final Function(int) onTap;

  const CustomBottomNavBar({
    Key? key,
    required this.selectedIndex,
    required this.onTap,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      height: kBottomNavigationBarHeight, // Ensures a standard height
      decoration: BoxDecoration(
        color: AppColors.richBlueGreen,
        boxShadow: [
          BoxShadow(
            color: Colors.black26,
            blurRadius: 10,
          ),
        ],
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: [
          _buildNavItem('assets/icons/home.png', 'Home', 0),
          _buildNavItem("assets/icons/session.png", 'Session', 1),
          _buildNavItem("assets/icons/client.png", 'Client', 2),
          _buildNavItem("assets/icons/portfolio.png", 'Portfolio', 3),
          _buildNavItem("assets/icons/profile.png", 'Profile', 4),
        ],
      ),
    );
  }

  Widget _buildNavItem(String? icon, String label, int index) {
    return GestureDetector(
      onTap: () => onTap(index),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Image.asset(
            icon!,
            color: selectedIndex == index ? Colors.green : Colors.white,
            height: 28,
          ),
          Text(
            label,
            style: TextStyle(
              color: selectedIndex == index ? Colors.green : Colors.white,
              fontSize: 12, // Adjust the font size
            ),
          ),
        ],
      ),
    );
  }
}
