import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/session_screen/session_controller.dart';
import 'package:needle_project/widgets/global_dropdown.dart';

class text_with_dropdown extends StatelessWidget {
  final String? txt;
  final global_dropdown gb;
  const text_with_dropdown({
    super.key,
    required this.sessionController,
    required this.txt,
    required this.gb,
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
        Container(height: 50, child: gb)
      ],
    );
  }
}
