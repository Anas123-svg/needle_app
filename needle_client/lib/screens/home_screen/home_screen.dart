import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/home_screen/home_screen_controller.dart';
import 'package:needle_project/utils/Colors.dart';
import 'package:needle_project/widgets/homeScreen_widgets/3smallContainers.dart';
import 'package:needle_project/widgets/homeScreen_widgets/container4/row_with_text.dart';
import 'package:needle_project/widgets/homeScreen_widgets/tablecelltext.dart';
import 'package:needle_project/widgets/homeScreen_widgets/tableheadertext.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  bool session = true;
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
                    GestureDetector(
                      onTap: () {
                        homeControllet.toggleSession();
                      },
                      child: Container(
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
                            Obx(() {
                              return Text(
                                  '${homeControllet.text_session.value}',
                                  style: GoogleFonts.montserrat(
                                      color: Color(0XFF1A5C48),
                                      fontWeight: FontWeight.w700,
                                      fontSize: 12));
                            }),
                            SizedBox(
                              width: 10,
                            ),
                          ],
                        ),
                      ),
                    ),
                    Stack(
                      children: [
                        // Centered Column with text and timer
                        Align(
                          alignment: Alignment.center,
                          child: Column(
                            children: [
                              Text(
                                'Current Day',
                                style: GoogleFonts.montserrat(
                                    color: Colors.white,
                                    fontSize: 16,
                                    fontWeight: FontWeight.w600),
                              ),
                              // Timer
                              Obx(() {
                                return Text(
                                  homeControllet.formattedTime,
                                  style: GoogleFonts.montserrat(
                                      color: Color(0XFFA6ED61),
                                      fontSize: 30,
                                      fontWeight: FontWeight.w500),
                                );
                              }),
                            ],
                          ),
                        ),
                        Obx(() {
                          if (homeControllet.sessionStart.value) {
                            return Positioned(
                              left: 20,
                              top: -50,
                              child: Image.asset(
                                'assets/images/qrcode.png',
                                width: w * 0.2,
                                height: h * 0.2,
                              ),
                            );
                          } else {
                            return SizedBox.shrink();
                          }
                        }),
                      ],
                    )

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

            //Home New Session
            Obx(() {
              return homeControllet.sessionStart.value
                  ? AnimatedContainer(
                      duration: Duration(milliseconds: 400),
                      curve: Curves.easeIn,
                      margin: EdgeInsets.only(top: 20),
                      decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(20),
                          border: Border.all(
                              width: 3, color: AppColors.richGreen1)),
                      width: double.infinity,
                      child: Column(
                        children: [
                          sesssion_ended(
                            padding: EdgeInsets.symmetric(
                                vertical: 15, horizontal: 20),
                            containerDecoration: BoxDecoration(
                                borderRadius: BorderRadius.only(
                                  topLeft: Radius.circular(15),
                                  topRight: Radius.circular(15),
                                ),
                                gradient: LinearGradient(colors: [
                                  AppColors.richGreen1,
                                  AppColors.richGreen2,
                                ])),
                            txt1: Text(
                              'Timer'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.whiteColor,
                                  fontSize: 25,
                                  fontWeight: FontWeight.w600),
                            ),
                            txt2: Text(
                              '01:54:20'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.whiteColor,
                                  fontSize: 25,
                                  fontWeight: FontWeight.w600),
                            ),
                          ),
                          sesssion_ended(
                            padding: EdgeInsets.symmetric(
                                vertical: 15, horizontal: 20),
                            containerDecoration: BoxDecoration(
                                border: Border(bottom: BorderSide())),
                            txt1: Text(
                              'Actual rate'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen,
                                  fontSize: 16,
                                  fontWeight: FontWeight.w700),
                            ),
                            txt2: Text(
                              '285.65\$'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen,
                                  fontSize: 18,
                                  fontWeight: FontWeight.w700),
                            ),
                          ),
                          sesssion_ended(
                            padding: EdgeInsets.symmetric(
                                vertical: 15, horizontal: 20),
                            containerDecoration: BoxDecoration(
                                border: Border(bottom: BorderSide())),
                            txt1: Text(
                              'taxes'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen,
                                  fontSize: 16,
                                  fontWeight: FontWeight.w700),
                            ),
                            txt2: Text(
                              '355.28\$'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen,
                                  fontSize: 18,
                                  fontWeight: FontWeight.w700),
                            ),
                          ),
                          sesssion_ended(
                            padding: EdgeInsets.symmetric(
                                vertical: 15, horizontal: 20),
                            containerDecoration: BoxDecoration(
                                border: Border(bottom: BorderSide())),
                            txt1: Text(
                              'Actual rate'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen,
                                  fontSize: 16,
                                  fontWeight: FontWeight.w700),
                            ),
                            txt2: Text(
                              '325\$'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen,
                                  fontSize: 18,
                                  fontWeight: FontWeight.w700),
                            ),
                          ),
                          sesssion_ended(
                            padding: EdgeInsets.symmetric(
                                vertical: 20, horizontal: 20),
                            containerDecoration: BoxDecoration(),
                            txt1: Text(
                              'total'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen3,
                                  fontSize: 25,
                                  fontWeight: FontWeight.w700),
                            ),
                            txt2: Text(
                              '380.28\$'.toUpperCase(),
                              style: GoogleFonts.montserrat(
                                  color: AppColors.richGreen3,
                                  fontSize: 25,
                                  fontWeight: FontWeight.w700),
                            ),
                          ),
                        ],
                      ),
                    )
                  : AnimatedContainer(
                      duration: Duration(milliseconds: 400),
                      curve: Curves.easeIn,
                      child: Column(
                        children: [
                          //Container 2
                          Container(
                            padding: EdgeInsets.all(15),
                            width: double.infinity,
                            margin: EdgeInsets.only(top: 15),
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(20),
                                border: Border.all(
                                    width: 3, color: Color(0XFF1A5C48))),
                            child: Column(
                              children: [
                                Container(
                                  height: h * 0.04,
                                  child: TextField(
                                    decoration: InputDecoration(
                                        focusedBorder: OutlineInputBorder(),
                                        enabledBorder: OutlineInputBorder(
                                            borderRadius:
                                                BorderRadius.circular(20),
                                            borderSide: BorderSide(
                                              color: Colors.grey.shade400,
                                            )),
                                        border: InputBorder.none,
                                        labelStyle: GoogleFonts.montserrat(
                                            fontSize: 10),
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
                                                bottom: BorderSide(
                                                    color: Color(0XFFC2523E)))),
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
                                                bottom: BorderSide(
                                                    color: Color(0XFFC2523E)))),
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
                                                bottom: BorderSide(
                                                    color: Color(0XFFC2523E)))),
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
                                                bottom: BorderSide(
                                                    color: Color(0XFFC2523E)))),
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
                                    image: AssetImage(
                                        'assets/images/Container3.png'))),
                          ),
                          //Container 4
                          Container(
                            child: Row(
                              children: [
                                Expanded(
                                    flex: 1,
                                    child: Container(
                                      decoration: BoxDecoration(
                                          borderRadius:
                                              BorderRadius.circular(10),
                                          gradient: LinearGradient(colors: [
                                            AppColors.richGreen1,
                                            AppColors.richGreen2
                                          ])),
                                      child: Column(
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: [
                                          Text(
                                            '\$',
                                            style: GoogleFonts.montserrat(
                                                color: Colors.white,
                                                fontWeight: FontWeight.w700,
                                                fontSize: 22),
                                          ),
                                          Text(
                                            '10,000',
                                            style: GoogleFonts.montserrat(
                                                color: Colors.white,
                                                fontWeight: FontWeight.w700,
                                                fontSize: 22),
                                          ),
                                          Text(
                                            'Today Earning',
                                            style: GoogleFonts.montserrat(
                                                color: Colors.white,
                                                fontWeight: FontWeight.w500,
                                                fontSize: 13),
                                          )
                                        ],
                                      ),
                                    )),
                                Expanded(
                                  flex: 2,
                                  child: Container(
                                    height: h * 0.1,
                                    margin: EdgeInsets.only(left: 15),
                                    decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(10),
                                        gradient: LinearGradient(colors: [
                                          AppColors.richGreen1,
                                          AppColors.richGreen2
                                        ])),
                                    child: Column(
                                      mainAxisAlignment:
                                          MainAxisAlignment.center,
                                      children: [
                                        row_generate_two_text(
                                          txt1: 'Today',
                                          txt2: '10,000',
                                        ),
                                        row_generate_two_text(
                                          txt1: 'This week',
                                          txt2: '25,000',
                                        ),
                                        row_generate_two_text(
                                          txt1: 'This month',
                                          txt2: '30,000',
                                        ),
                                        Text(
                                          'Complete History',
                                          style: GoogleFonts.montserrat(
                                              fontWeight: FontWeight.w700,
                                              fontSize: 12,
                                              color: AppColors.mintyGreen),
                                        )
                                      ],
                                    ),
                                  ),
                                )
                              ],
                            ),
                          )
                        ],
                      ),
                    );
            })
          ],
        ),
      ),
    );
  }
}

class sesssion_ended extends StatelessWidget {
  final Text? txt1;

  final Text? txt2;
  final EdgeInsets? padding;
  final BoxDecoration? containerDecoration;

  const sesssion_ended({
    super.key,
    this.txt1,
    this.txt2,
    this.containerDecoration,
    this.padding,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: padding,
      decoration: containerDecoration,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [txt1!, txt2!],
      ),
    );
  }
}
