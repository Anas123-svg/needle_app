import 'package:get/get.dart';

import 'package:needle_project/routes/app_routes.dart';
import 'package:needle_project/screens/splashscreen/splashscreen.dart';

class AppPages {
  static final appRoutes = [
    GetPage(name: Routes.splash, page: () => const SplashScreen()),
    GetPage(name: Routes.splash, page: () => const SplashScreen()),
  ];
}
