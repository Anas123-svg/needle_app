import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/Main_screen/main_Screen.dart';
import 'package:needle_project/screens/home_screen/home_screen.dart';
import 'package:needle_project/utils/Colors.dart';

class global_button extends StatefulWidget {
  final VoidCallback? callBackFunction;
  final BoxDecoration? containerDecoration;
  final Text? buttonText;
  final String? Leadingimage;
  const global_button({
    super.key,
    this.Leadingimage,
    this.buttonText,
    this.containerDecoration,
    this.callBackFunction,
  });

  @override
  State<global_button> createState() => _global_buttonState();
}

class _global_buttonState extends State<global_button> {
  @override
  Widget build(BuildContext context) {
    double h = MediaQuery.of(context).size.height;
    double w = MediaQuery.of(context).size.width;

    return GestureDetector(
      onTap: widget.callBackFunction,
      child: Container(
          padding: EdgeInsets.all(10),
          decoration: widget.containerDecoration,
          width: double.infinity,
          height: 50,
          child: widget.Leadingimage != null
              ? Row(
                  children: [
                    Image.asset(
                      '${widget.Leadingimage}',
                      height: h * 0.07,
                      width: w * 0.07,
                    ),
                    Expanded(
                      child: Center(
                        child: widget.buttonText!,
                      ),
                    ),
                    // Right blank space
                    SizedBox(
                      width: w *
                          0.07, // Adjust the width as needed for the blank space
                    ),
                  ],
                )
              : Center(
                  child: widget.buttonText!,
                )),
    );
  }
}
