import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class row_generate_two_text extends StatelessWidget {
  final String? txt1, txt2;

  const row_generate_two_text({
    super.key,
    this.txt1,
    this.txt2,
  });

  @override
  Widget build(BuildContext context) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Text(
          '$txt1',
          style: GoogleFonts.montserrat(
              color: Colors.white, fontWeight: FontWeight.w700, fontSize: 13),
        ),
        Text(
          '$txt2\$',
          style: GoogleFonts.montserrat(
              color: Colors.white, fontWeight: FontWeight.w700, fontSize: 13),
        ),
      ],
    );
  }
}
