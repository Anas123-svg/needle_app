import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/Login_screen/loginscreen_Controller.dart';
import 'package:needle_project/utils/Colors.dart';

class global_textfield extends StatefulWidget {
  final InputDecoration textfieldDecoration;
  final TextEditingController controller;

  const global_textfield({
    super.key,
    required this.controller,
    required this.textfieldDecoration,
  });

  @override
  State<global_textfield> createState() => _global_textfieldState();
}

class _global_textfieldState extends State<global_textfield> {
  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(bottom: 10),
      width: double.infinity,
      child: TextFormField(
        decoration: widget.textfieldDecoration,
        controller: widget.controller,
      ),
    );
  }
}
