class Endpoints {
  Endpoints._();

  static const String baseURL = 'https://dev.20seconds.it/api/';

  static const int receiveTimeout = 50000;

  static const int connectionTimeout = 30000;

  static const String employmentStatusUser =
      'statoLavorativo/allByRuolo?idRuolo=3';
  static const String checkUsername = 'auth/checkUsername';

  static const String employmentStatusCompany =
      'statoLavorativo/allByRuolo?idRuolo=4';

  static const String categories = 'categorie/all';

  static const String communities = 'geoInfo/comuni';

  static const String signUpIndividual = 'auth/registraUtente';

  static const String signUpCompany = 'auth/registraAzienda';

  static const String login = 'auth/login';

  static const String chatRoom = 'messaggi/elencoChat';

  static const String chatMessages = 'messaggi/chat';

  static const String sendMessage = 'messaggi/inviaMess';

  static const String userNotifications = 'utente/notifiche';

  static const String forgotPassword = 'auth/recuperaPassword';

  static const String homeFeed = 'video/feed';

  static const String likePost = 'video/toggleLike';

  static const String reportVideo = 'video/segnala';

  static const String saveVideo = 'video/togglePreferito';

  static const String personalProfile = 'utente/infoPersonali';

  static const String otherUserProfile = 'utente/info';

  static const String changePassword = 'auth/cambiaPassword';

  static const String getComment = 'commenti';

  static const String addComment = 'commenti/addCommento';

  static const String likeComment = 'commenti/toggleLike';

  static const String reportComment = 'commenti/segnala';

  static const String deleteUser = 'utente/deleteUser';

  static const String changePhoto = 'utente/cambiaFoto';

  static const String editUserInfo = 'utente/editInfo';

  static const String addSocial = 'utente/addSocial';

  static const String updateSocial = 'utente/updateSocial';

  static const String deleteSocial = 'utente/removeSocial';

  static const String removeSocial = 'utente/removeSocial';

  static const String editBio = 'utente/editBio';

  static const String userUploadedVideo = 'video/videoByUtente';

  static const String bookmarkVideo = 'video/videoPreferiti';

  static const String likeVideo = 'stats/cronoLike';

  static const String searchVideo = 'video/cerca';

  static const String showReportedComments = 'commenti/segnalazioni';

  static const String ignoreReportedComments = 'commenti/gestioneSegnalazione';

  static const String ignoreReportedVideos = 'video/gestioneSegnalazione';

  static const String viewVideo = 'video/visualizza';

  static const String showReportedVideos = 'video/segnalazioni';

  static const String uploadVideo = 'video/upload';

  static const String provinceId = 'geoInfo/province';

  static const String searchUser = 'utente/ricerca';

  static const String deleteVideo = 'video/elimina';

  static const String deleteComment = 'commenti/removeCommento';

  static const String pinVideo = 'video/togglePinnato';

  static const String getVideo = 'video';

  static const String changeUserRole = 'utente/cambioRuolo';

  static const String allUtility = 'utility/all';

  static const String searchUtility = 'utility/byKey';

  static const String editUtility = 'utility/updateByKey';

  static const String sendOneNotification = 'notifiche/sendOne';

  static const String notificationsByRule = 'notifiche/sendByRuolo';

  static const String blockUser = 'utente/segnala';

}
