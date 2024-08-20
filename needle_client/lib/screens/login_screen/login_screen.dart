import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/main.dart';
import 'package:needle_project/screens/Login_screen/loginscreen_Controller.dart';
import 'package:needle_project/screens/home_screen/home_screen.dart';
import 'package:needle_project/screens/main_screen/main_Screen.dart';
import 'package:needle_project/utils/Colors.dart';
import 'package:needle_project/widgets/global_button.dart';
import 'package:needle_project/widgets/global_textField.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final LoginController loginController = Get.put(LoginController());

  @override
  Widget build(BuildContext context) {
    double height = MediaQuery.of(context).size.height;
    double width = MediaQuery.of(context).size.width;

    return Scaffold(
      appBar: AppBar(),
      backgroundColor: AppColors.whiteColor,
      body: Container(
        padding: EdgeInsets.symmetric(horizontal: 25, vertical: 30),
        child: Column(
          children: [
            // Welcome Texts aligned to the top
            Align(
              alignment: Alignment.topLeft,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Welcome Back',
                    style: GoogleFonts.montserrat(
                      fontSize: 27,
                      color: Colors.black,
                      fontWeight: FontWeight.w700,
                    ),
                  ),
                  Text(
                    'Login to your account',
                    style: GoogleFonts.montserrat(
                      fontSize: 17,
                      color: AppColors.mintyGreen,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                ],
              ),
            ),

            // Add some space before the form fields
            SizedBox(height: height * 0.03),

            // Form fields
            Form(
              key: loginController.formKey,
              child: Column(
                children: [
                  global_textfield(
                    textfieldDecoration: InputDecoration(
                        labelText: 'Email',
                        labelStyle: GoogleFonts.montserrat(
                            color: AppColors.mediumGray,
                            fontWeight: FontWeight.w500,
                            fontSize: 15),
                        focusedBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.black),
                            borderRadius: BorderRadius.circular(20)),
                        enabledBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: AppColors.lightGray),
                            borderRadius: BorderRadius.circular(20)),
                        prefixIcon: Image.asset('assets/icons/email.png')),
                    controller: loginController.emailController,
                  ),
                  SizedBox(height: height * 0.02),
                  global_textfield(
                    textfieldDecoration: InputDecoration(
                        labelText: 'Password',
                        labelStyle: GoogleFonts.montserrat(
                            color: AppColors.mediumGray,
                            fontWeight: FontWeight.w500,
                            fontSize: 15),
                        focusedBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.black),
                            borderRadius: BorderRadius.circular(20)),
                        enabledBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: AppColors.lightGray),
                            borderRadius: BorderRadius.circular(20)),
                        prefixIcon: Image.asset('assets/icons/password.png')),
                    controller: loginController.passwordController,
                  ),
                ],
              ),
            ),

            // Add some space after the form fields
            SizedBox(height: height * 0.05),

            // Buttons
            global_button(
              w: double.infinity,
              h: 50,
              callBackFunction: () {
                Navigator.push(context,
                    MaterialPageRoute(builder: (context) => MainScreen()));
              },
              containerDecoration: BoxDecoration(
                borderRadius: BorderRadius.circular(30),
                color: AppColors.paleLimeGreen,
              ),
              Leadingimage: null,
              anyWidget: Text(
                'Login',
                style: GoogleFonts.montserrat(
                  color: Colors.white,
                  fontSize: 20,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ),
            SizedBox(height: height * 0.02),
            global_button(
              w: double.infinity,
              h: 50,
              containerDecoration: BoxDecoration(
                border: Border.all(),
                borderRadius: BorderRadius.circular(30),
                color: Colors.white,
              ),
              anyWidget: Row(
                children: [
                  Image.asset(
                    'assets/icons/gmail_icon.png',
                    height: height * 0.07,
                    width: width * 0.07,
                  ),
                  Expanded(
                    child: Center(
                      child: Text(
                        'Sign Up with Google',
                        style: GoogleFonts.montserrat(
                          color: Colors.black,
                          fontSize: 16,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                  ),
                  // Right blank space
                  SizedBox(
                    width: width *
                        0.07, // Adjust the width as needed for the blank space
                  ),
                ],
              ),
            ),
            Spacer(),
            GestureDetector(
              onTap: () {},
              child: Container(
                width: width * 0.5,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      'New User?',
                      style: GoogleFonts.montserrat(
                        color: Colors.black,
                        fontWeight: FontWeight.w500,
                        fontSize: 15,
                      ),
                    ),
                    Text(
                      ' Sign up',
                      style: GoogleFonts.montserrat(
                        color: Color(0XFFED6161),
                        fontWeight: FontWeight.w600,
                        fontSize: 15,
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
