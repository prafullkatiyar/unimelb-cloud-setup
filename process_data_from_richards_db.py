import sys
import json
from textblob import TextBlob
from dateutil import parser

from shapely.geometry import Point, Polygon

def main(argv):

    jsondata = "{\"new_edits\":false,\"docs\":["

    i=0
    done=0
    skipped =0

    with open(argv[1]) as f:
            for line in f:
                if (i>=int(argv[2]) and i<int(argv[3]) and i%2==int(argv[5])):
                    if (line[-2]) == ",":
                        line = line[0:-2]
                    try:
                        post = json.loads(line)
                        text = post['doc']['text']
                        lng = post['doc']['coordinates']['coordinates'][0]
                        lat = post['doc']['coordinates']['coordinates'][1]
                        date= parser.parse(post['doc']['created_at'])
                        year= date.astimezone().year
                        month = date.astimezone().month
                        day = date.astimezone().day

                        location = Point(lng, lat)
                        analysis = TextBlob(text)


                    except:
                        skipped+=1
                        i+=1
                        continue

                    with open("rain_data.json",'r') as rain_data:
                        rain_json = json.load(rain_data)
                        try:
                            rain = rain_json[str(year)][str(month)][str(day)]
                            if (rain):
                                weather = "raining"
                            else:
                                weather = "sunny"
                        except:
                            weather = "unknown"

                    with open("Simplify_Melbourne_SA2.geojson", 'r', encoding="utf-8") as mel_geojson:
                        docs = json.load(mel_geojson)
                        features = docs['features']
                        # print(len(features))
                        for doc in features:
                            # print("doc",doc)
                            main_16 = doc['properties']['SA2_MAIN16']
                            # print("main_16",main_16)
                            name_16 = doc['properties']['SA2_NAME16']
                            # print("name_16",name_16)
                            # print(doc['geometry']['coordinates'][0])
                            polygon = Polygon(doc['geometry']['coordinates'][0])
                            # print("zzzpolygon",polygon)
                            if polygon.contains(location):
                                #print(post['doc'])
                                # print("contains the location")
                                post['doc']['properties'] = {'SA2_MAIN16': main_16, 'SA2_NAME16': name_16}
                                post['doc']['properties']['weather'] = weather
                                #print(post['doc'])
                                if (analysis.sentiment.polarity == 0):
                                    post['doc']['properties']['sentiment'] = "neutral"
                                elif (analysis.sentiment.polarity < 0.00):
                                    post['doc']['properties']['sentiment'] = "negative"
                                elif (analysis.sentiment.polarity > 0.00):
                                    post['doc']['properties']['sentiment'] = "positive"
                                #print(post['doc'])
                                break
                        jsondata += json.dumps(post['doc'])
                        jsondata += ","
                        done+=1
                if (i>int(argv[3])):
                    break
                i+=1
    jsondata = jsondata[0:-1]
    jsondata+="]}"

    with open(argv[4], "w+") as new_file:
        new_file.write(jsondata)
    print("done:",done,"skipped",skipped, "i",i)


if __name__== "__main__":
    main(sys.argv)