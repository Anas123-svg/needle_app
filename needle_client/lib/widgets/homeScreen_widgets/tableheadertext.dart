import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class TableHeaderText extends StatelessWidget {
  final String? name;
  const TableHeaderText({
    super.key,
    this.name,
  });

  @override
  Widget build(BuildContext context) {
    return Text(
      "$name",
      style: GoogleFonts.montserrat(
          fontWeight: FontWeight.w700, color: Color(0XFF108F86)),
    );
  }
}
