import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/home_screen/home_screen_controller.dart';
import 'package:needle_project/utils/Colors.dart';
import 'package:needle_project/widgets/homeScreen_widgets/3smallContainers.dart';
import 'package:needle_project/widgets/homeScreen_widgets/tablecelltext.dart';
import 'package:needle_project/widgets/homeScreen_widgets/tableheadertext.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  @override
  Widget build(BuildContext context) {
    double h = MediaQuery.of(context).size.height;
    double w = MediaQuery.of(context).size.width;
    final HomeScreenController homeControllet = Get.put(HomeScreenController());
    return Container(
      margin: EdgeInsets.symmetric(vertical: 15, horizontal: 25),
      width: double.infinity,
      height: h * 0.8,
      // decoration: BoxDecoration(border: Border.all()),
      child: SingleChildScrollView(
        child: Column(
          children: [
            //Container 1
            Container(
              width: double.infinity,
              height: h * 0.3,
              decoration: BoxDecoration(
                  image: DecorationImage(
                      fit: BoxFit.cover,
                      image: AssetImage('assets/images/Rectangle_353.png')),
                  borderRadius: BorderRadius.circular(20)),
              child: SingleChildScrollView(
                child: Column(
                  children: [
                    Container(
                      padding: EdgeInsets.symmetric(horizontal: 20),
                      margin: EdgeInsets.only(
                          left: 30, right: 30, top: 20, bottom: 10),
                      decoration: BoxDecoration(
                          shape: BoxShape.rectangle,
                          color: AppColors.mintyGreen,
                          borderRadius: BorderRadius.circular(10)),
                      height: h * 0.04,
                      width: double.infinity,
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Icon(
                            Icons.alarm,
                            color: Color(0XFF1A5C48),
                          ),
                          Text('Start New Session',
                              style: GoogleFonts.montserrat(
                                  color: Color(0XFF1A5C48),
                                  fontWeight: FontWeight.w700,
                                  fontSize: 12)),
                          SizedBox(
                            width: 10,
                          ),
                        ],
                      ),
                    ),
                    Text(
                      'Current Day',
                      style: GoogleFonts.montserrat(
                          color: Colors.white,
                          fontSize: 16,
                          fontWeight: FontWeight.w600),
                    ),
                    //Timer
                    Obx(() {
                      return Text(
                        homeControllet.formattedTime,
                        style: GoogleFonts.montserrat(
                            color: Color(0XFFA6ED61),
                            fontSize: 30,
                            fontWeight: FontWeight.w500),
                      );
                    })
                    // 3 Container
                    ,
                    Container(
                      margin:
                          EdgeInsets.symmetric(horizontal: 25, vertical: 10),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Small3Container(
                            h: h,
                            w: w,
                            containerColor: Color(0XFF08C875),
                            data: Text(
                              "0\$",
                              style: GoogleFonts.montserrat(
                                  fontWeight: FontWeight.w600,
                                  color: Colors.white,
                                  fontSize: 24),
                            ),
                          ),
                          Small3Container(
                              h: h,
                              w: w,
                              containerColor: Color(0XFF08C875),
                              data: Container(
                                decoration: BoxDecoration(
                                  image: DecorationImage(
                                    image: AssetImage(
                                      'assets/icons/Ellipse.png',
                                    ),
                                  ),
                                ),
                                child: Center(
                                  child: Image.asset('assets/icons/Vector.png'),
                                ),
                              )),
                          Small3Container(
                              h: h,
                              w: w,
                              containerColor: Color(0XFFED6161),
                              data: Image.asset(
                                'assets/icons/StopIcon.png',
                              ))
                        ],
                      ),
                    )
                    // Session History
                    ,
                    Text(
                      'Session history',
                      style: GoogleFonts.montserrat(
                          color: Colors.white,
                          fontSize: 12,
                          fontWeight: FontWeight.w700),
                    ),
                  ],
                ),
              ),
            ), // Container 2
            //Container 2
            Container(
              padding: EdgeInsets.all(15),
              width: double.infinity,
              margin: EdgeInsets.only(top: 15),
              decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(20),
                  border: Border.all(width: 3, color: Color(0XFF1A5C48))),
              child: Column(
                children: [
                  Container(
                    height: h * 0.04,
                    child: TextField(
                      decoration: InputDecoration(
                          focusedBorder: OutlineInputBorder(),
                          enabledBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(20),
                              borderSide: BorderSide(
                                color: Colors.grey.shade400,
                              )),
                          border: InputBorder.none,
                          labelStyle: GoogleFonts.montserrat(fontSize: 10),
                          labelText: 'Search for a client'),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(top: 10),
                    padding: EdgeInsets.all(10),
                    child: Table(
                      columnWidths: {
                        0: FlexColumnWidth(0.7),
                        1: FlexColumnWidth(1.1),
                        2: FlexColumnWidth()
                      },
                      children: [
                        TableRow(children: [
                          TableCell(
                              child: TableHeaderText(
                            name: "Name",
                          )),
                          TableCell(
                              child: TableHeaderText(
                            name: "Tattoo Type",
                          )),
                          TableCell(
                              child: TableHeaderText(
                            name: "Availability",
                          )),
                        ]),
                        // Data Row 1
                        TableRow(
                          decoration: BoxDecoration(
                              border: Border(
                                  bottom:
                                      BorderSide(color: Color(0XFFC2523E)))),
                          children: [
                            TableCellText(
                              name: 'abc',
                            ),
                            TableCellText(
                              name: 'Traditional',
                            ),
                            TableCellText(
                              name: '12:00pm',
                            )
                          ],
                        ),
                        // Data Row 2
                        TableRow(
                          decoration: BoxDecoration(
                              border: Border(
                                  bottom:
                                      BorderSide(color: Color(0XFFC2523E)))),
                          children: [
                            TableCellText(
                              name: 'abc',
                            ),
                            TableCellText(
                              name: 'Traditional',
                            ),
                            TableCellText(
                              name: '12:00pm',
                            )
                          ],
                        ),

                        // Data Row 1
                        TableRow(
                          decoration: BoxDecoration(
                              border: Border(
                                  bottom:
                                      BorderSide(color: Color(0XFFC2523E)))),
                          children: [
                            TableCellText(
                              name: 'abc',
                            ),
                            TableCellText(
                              name: 'Traditional',
                            ),
                            TableCellText(
                              name: '12:00pm',
                            )
                          ],
                        ),

                        // Data Row 1
                        TableRow(
                          decoration: BoxDecoration(
                              border: Border(
                                  bottom:
                                      BorderSide(color: Color(0XFFC2523E)))),
                          children: [
                            TableCellText(
                              name: 'abc',
                            ),
                            TableCellText(
                              name: 'Traditional',
                            ),
                            TableCellText(
                              name: '12:00pm',
                            )
                          ],
                        ),
                      ],
                    ),
                  )
                ],
              ),
            ), //Container 3
            //Container 3
            Container(
              height: h * 0.2,
              width: double.infinity,
              decoration: BoxDecoration(
                  image: DecorationImage(
                      fit: BoxFit.cover,
                      image: AssetImage('assets/images/Container3.png'))),
            ),
            //Container 4
            Container(
              width: double.infinity,
              child: Row(
                children: [
                  Container(
                    padding: EdgeInsets.symmetric(horizontal: 10, vertical: 15),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      gradient: LinearGradient(
                        colors: [
                          AppColors.richGreen1,
                          AppColors.richGreen2,
                        ],
                      ),
                    ),
                    child: Column(
                      children: [
                        Text(
                          '\$',
                          style: GoogleFonts.montserrat(
                              fontSize: 23,
                              color: AppColors.whiteColor,
                              fontWeight: FontWeight.w700),
                        ),
                        Text(
                          '10,000',
                          style: GoogleFonts.montserrat(
                              fontSize: 23,
                              color: AppColors.whiteColor,
                              fontWeight: FontWeight.w700),
                        ),
                        Text(
                          'Today Earning',
                          style: GoogleFonts.montserrat(
                              fontSize: 13,
                              color: AppColors.whiteColor,
                              fontWeight: FontWeight.w700),
                        )
                      ],
                    ),
                  ),
                  Container(
                    padding: EdgeInsets.symmetric(horizontal: 15, vertical: 29),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      gradient: LinearGradient(
                        colors: [
                          AppColors.richGreen1,
                          AppColors.richGreen2,
                        ],
                      ),
                    ),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        column_three_text(
                          txt1: 'Today',
                          txt2: 'This week',
                          txt3: 'This month',
                        ),
                        SizedBox(
                          width: 20,
                        ),
                        column_three_text(
                          txt1: '10,000\$',
                          txt2: '25,000\$',
                          txt3: '50,000\$',
                        )
                      ],
                    ),
                  )
                ],
              ),
            )
          ],
        ),
      ),
    );
  }
}

class column_three_text extends StatelessWidget {
  final String? txt1, txt2, txt3;
  const column_three_text({
    super.key,
    this.txt1,
    this.txt2,
    this.txt3,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          '$txt1',
          style: GoogleFonts.montserrat(
              fontSize: 13,
              color: AppColors.whiteColor,
              fontWeight: FontWeight.w700),
        ),
        Text(
          '$txt2',
          style: GoogleFonts.montserrat(
              fontSize: 13,
              color: AppColors.whiteColor,
              fontWeight: FontWeight.w700),
        ),
        Text(
          '$txt3',
          style: GoogleFonts.montserrat(
              fontSize: 13,
              color: AppColors.whiteColor,
              fontWeight: FontWeight.w700),
        ),
      ],
    );
  }
}

class single_row_for_both_text extends StatelessWidget {
  final String? txt1;
  final String? txt2;

  const single_row_for_both_text({
    super.key,
    this.txt1,
    this.txt2,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Text(
          '$txt1',
          style: GoogleFonts.montserrat(
              fontSize: 13,
              color: AppColors.whiteColor,
              fontWeight: FontWeight.w700),
        ),
        Spacer(),
        Text(
          '$txt2\$',
          style: GoogleFonts.montserrat(
              fontSize: 13,
              color: AppColors.whiteColor,
              fontWeight: FontWeight.w700),
        )
      ],
    );
  }
}
