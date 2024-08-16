import 'package:get/get.dart';
import 'package:needle/routes/app_routes.dart';
import 'package:needle/screens/splash_screen.dart';


class AppPages {
  static final appRoutes = [
    GetPage(name: Routes.splash, page: () => const SplashScreen()),
  ];
}
