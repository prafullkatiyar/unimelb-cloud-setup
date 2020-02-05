function (doc) {
  var sentimentJson = {};
  sentimentJson[doc.properties.sentiment] = 1;
  emit({"SA2_NAME16":doc.properties.SA2_NAME16,"SA2_MAIN16":doc.properties.SA2_MAIN16}, sentimentJson);
}
