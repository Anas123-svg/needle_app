import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class TableCellText extends StatelessWidget {
  final String? name;
  const TableCellText({
    super.key,
    this.name,
  });

  @override
  Widget build(BuildContext context) {
    return TableCell(
      child: Padding(
        padding: const EdgeInsets.only(bottom: 15, top: 15),
        child: Text(
          '$name',
          style: GoogleFonts.montserrat(fontSize: 11, color: Color(0XFFC2523E)),
        ),
      ),
    );
  }
}
