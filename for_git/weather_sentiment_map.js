function (doc) {
  var sentimentJson = {};
  sentimentJson[doc.properties.sentiment] = 1;
  emit({"weather":doc.properties.weather}, sentimentJson);
  emit({"weather":"all weather"}, sentimentJson);
}
