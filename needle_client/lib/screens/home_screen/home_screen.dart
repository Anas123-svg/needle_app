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
                                  color: Colors.white, fontSize: 24),
                            ),
                          ),
                          Small3Container(
                            h: h,
                            w: w,
                            containerColor: Color(0XFF08C875),
                            data: Icon(
                              Icons.play_circle,
                              color: Colors.white,
                              size: 40,
                            ),
                          ),
                          Small3Container(
                              h: h,
                              w: w,
                              containerColor: Color(0XFFED6161),
                              data: Icon(
                                Icons.play_circle,
                                color: Colors.white,
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
                          fontSize: 16,
                          fontWeight: FontWeight.w600),
                    ),
                  ],
                ),
              ),
            )
            // Container 2
            ,
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
                          labelStyle: GoogleFonts.montserrat(),
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
            )
          ],
        ),
      ),
    );
  }
}
