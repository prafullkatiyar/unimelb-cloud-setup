#!/usr/bin/env python3

import time
import json
from textblob import TextBlob
import re
import shapely
from shapely.geometry import Point, Polygon

def sentiment_geocodes(fname1,fname2):
    result = []
    with open(fname1, 'r+', encoding = "utf-8") as geo_tweets:
        data = json.load(geo_tweets)
        for item in data['rows']:
            try:
                text = item['value']['properties']['text']
                lng = item['value']['geometry']['coordinates'][0]
                lat = item['value']['geometry']['coordinates'][1]
                location = Point(lng, lat)
                #print("location", location)
                analysis = TextBlob(text)
                #print("analysis.sentiment.polarity", analysis.sentiment.polarity)
               
                with open("Simplify_Melbourne_SA2.geojson",'r', encoding = "utf-8") as mel_geojson:
                    docs = json.load(mel_geojson)
                    features = docs['features']
                    #print(len(features))
                    for doc in features:
                        #print("doc",doc)
                        main_16 = doc['properties']['SA2_MAIN16']
                        #print("main_16",main_16)
                        name_16 = doc['properties']['SA2_NAME16']
                        #print("name_16",name_16)
                        #print(doc['geometry']['coordinates'][0])
                        polygon = Polygon(doc['geometry']['coordinates'][0])
                        #print("zzzpolygon",polygon)
                        if polygon.contains(location):
                            #print("contains the location")
                            item['value']['properties']['SA2_MAIN16'] = main_16
                            item['value']['properties']['SA2_NAME16'] = name_16
                            if(analysis.sentiment.polarity == 0):
                                item['value']['properties']['sentiment'] = "neutral"
                            elif(analysis.sentiment.polarity < 0.00):
                                item['value']['properties']['sentiment'] = "negative"
                            elif(analysis.sentiment.polarity > 0.00):
                                item['value']['properties']['sentiment'] = "positive"
                            break
            except ValueError:
                continue


        result = data
    with open(fname2,'a',encoding = "utf-8" ) as new_file:
        print("writing",fname1,"into the json file.")
        #print("writing result")
        data = json.dump(result, new_file)
        #print("writing in new_file", tweet)
                                
    return None


if __name__ == "__main__":
    sentiment_geocodes("r1r0_r1r1.json","r1r0_r1r1_result.json")









    
