function (doc) {
  time = (parseInt(doc.created_at.split(" ")[3].split(":")[0])+10)%24
  var timeJson = {};
  var sentimentJson = {};
  sentimentJson[doc.properties.sentiment] = 1;
  timeJson[time] = sentimentJson;
  emit({"SA2_NAME16":doc.properties.SA2_NAME16,"SA2_MAIN16":doc.properties.SA2_MAIN16}, timeJson);
  emit("ALL_SUBURBS", timeJson)
}
