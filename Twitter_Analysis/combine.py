#!/usr/bin/env python3

import time
import json
from textblob import TextBlob
import re
import shapely
from shapely.geometry import Point, LineString, Polygon


def combine_results(fname1, fname2):
    result = []
    with open(fname1, 'r+', encoding = "utf-8") as f:
        data = json.load(f)
        for item in data['rows']:
            try:
                lng = item['value']['geometry']['coordinates'][0]
                lat = item['value']['geometry']['coordinates'][1]
                location = Point(lng, lat)
                with open("Simplify_Melbourne_SA2.geojson",'r', encoding = "utf-8") as mel_geojson:
                    docs = json.load(mel_geojson)
                    features = docs['features']
                    #print(len(features))
                    for doc in features:
                        polygon = Polygon(doc['geometry']['coordinates'][0])
                        #print("zzzpolygon",polygon)
                        if polygon.contains(location):
                            result.append(item)
                            break
            except ValueError:
                continue

        with open(fname2,'a',encoding = "utf-8" ) as new_file:
            print("combining",fname1,"into the json file.")
            #print("writing result")
            data['rows'] = result
            data['total_rows'] = len(result)
            data_new = json.dump(data, new_file)
            #print("writing in new_file", tweet)

def add_results(result_file, file_added):
    result = []
    result_add = []
    with open(file_added, 'r+', encoding = "utf-8") as f:
        data = json.load(f)
        for item in data['rows']:
            try:
                lng = item['value']['geometry']['coordinates'][0]
                lat = item['value']['geometry']['coordinates'][1]
                location = Point(lng, lat)
                with open("Simplify_Melbourne_SA2.geojson",'r', encoding = "utf-8") as mel_geojson:
                    docs = json.load(mel_geojson)
                    features = docs['features']
                    #print(len(features))
                    for doc in features:
                        polygon = Polygon(doc['geometry']['coordinates'][0])
                        #print("zzzpolygon",polygon)
                        if polygon.contains(location):
                            result.append(item)
                            break
            except ValueError:
                continue
    with open(result_file,'r+',encoding = "utf-8" ) as new_file:
        new_file_data = json.load(new_file)
        print("combining",file_added,"into the json file.")
        #print("writing result")
        new_file_data['rows'] = new_file_data['rows'] + result
        new_file_data['total_rows'] = len(result) + len(new_file_data['rows'])
        # data_new = json.dump(new_file_data, new_file)
        #print("writing in new_file", tweet)
        result_add = new_file_data

    with open(result_file, 'w+', encoding="utf-8") as f:
        data = json.dump(result_add, f)

        
if __name__ == "__main__":
    combine_results("r1r0_r1r1_result.json", "final_result.json")
    add_results("final_result.json", "r1r1_r1r3_result.json")
    add_results("final_result.json", "r1r4_r1r6_result.json")
    add_results("final_result.json", "r1r6_r1r8_result.json")
    add_results("final_result.json", "r1r7_r1r9_result.json")
    add_results("final_result.json", "r1pj_r1pq_result.json")
    add_results("final_result.json", "r1qb_r1qf_result.json")
    add_results("final_result.json", "r1nv_r1nz_result.json")









    








