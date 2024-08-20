import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/session_screen/session_controller.dart';
import 'package:needle_project/widgets/global_textField.dart';

class text_with_textfield extends StatelessWidget {
  final global_textfield? gb;
  final String? txt;
  const text_with_textfield({
    super.key,
    required this.sessionController,
    required this.txt,
    this.gb,
  });

  final SessionController sessionController;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          '$txt',
          style:
              GoogleFonts.montserrat(fontWeight: FontWeight.w600, fontSize: 15),
        ),
        Container(height: 30, child: gb),
      ],
    );
  }
}
