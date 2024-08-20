import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/Login_screen/login_screen.dart';
import 'package:needle_project/utils/Colors.dart';
import 'package:needle_project/widgets/global_button.dart';

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  Widget build(BuildContext context) {
    double height = MediaQuery.of(context).size.height;
    double width = MediaQuery.of(context).size.width;

    return Scaffold(
      body: Container(
        width: double.infinity,
        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [AppColors.lightGreen, AppColors.darkGreen],
            stops: [0.0324, 0.9766],
          ),
        ),
        child: Padding(
          padding: const EdgeInsets.symmetric(vertical: 50, horizontal: 20),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              // Logo Container
              Container(
                width: width * 0.5, // Adjust width relative to screen width
                child: Image.asset(
                  'assets/logo/Rectangle_437.png',
                  height: height * 0.25, // Keep aspect ratio
                ),
              ),
              // Title
              Text(
                'by Mike Reeves',
                style: GoogleFonts.montserrat(fontWeight: FontWeight.w700),
              ),
              // Flexible Spacer
              Expanded(
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      'Mickael Rivard'.toUpperCase(),
                      style: GoogleFonts.montserrat(
                          fontWeight: FontWeight.bold,
                          color: AppColors.brightTealGreen,
                          fontSize: 30),
                    ),
                    Text(
                      "Artist growth manager",
                      style: GoogleFonts.montserrat(
                          fontWeight: FontWeight.w500, fontSize: 15),
                    ),
                  ],
                ),
              ),
              // Button Container
              global_button(
                w: double.infinity,
                h: 50,
                callBackFunction: () {
                  Navigator.push(context,
                      MaterialPageRoute(builder: (context) => LoginScreen()));
                },
                containerDecoration: BoxDecoration(
                  color: AppColors.tealblue,
                  borderRadius: BorderRadius.circular(30),
                ),
                anyWidget: Text(
                  "Let's Go!",
                  style: GoogleFonts.montserrat(
                      fontSize: 20,
                      fontWeight: FontWeight.w700,
                      color: Colors.white),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
