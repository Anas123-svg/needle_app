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
        padding: const EdgeInsets.only(left: 8.0, right: 8, bottom: 8, top: 10),
        child: Text(
          '$name',
          style: GoogleFonts.montserrat(color: Color(0XFFC2523E)),
        ),
      ),
    );
  }
}
