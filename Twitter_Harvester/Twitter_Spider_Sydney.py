#!/usr/bin/env python3

from tweepy import Stream
from tweepy import OAuthHandler
from tweepy.streaming import StreamListener
import time
import json
import couchdb

ckey = 'es5wyktQqbZlsviFfenC5ZCnV' #consumer key
csecret = 'sqJe5I2wKOPcMC8eds1ATcVGpqlaIWG40hiCz9DzvHJBr1ntBf' #consumer secret
atoken = '987955571801313281-AbJPLClnKfNto9Op3NJwJohbzSaEEHL' #access token
asecret = 'LHClRA1p42lEF5ttx3Hm2ayZYksIS8rqJwHd0YFuslOX9' #access secret

# create an authenticated connection to couchdb
user = "admin"
password = "admin"
couchserver = couchdb.Server("http://%s:%s@172.17.0.2:5984/" % (user, password))

dbname = "sydney_tweetdb_no_locations" # the name of our databse for tweets without locations
if dbname in couchserver:
    db_no_location = couchserver[dbname]
else:
    db_no_location = couchserver.create(dbname)

dbname_location = "sydney_tweetdb_with_locations" # the name of our databse for tweets with locations

if dbname_location in couchserver:
    db_with_location = couchserver[dbname_location]
else:
    db_with_location = couchserver.create(dbname_location)

class listener(StreamListener):

    def on_data(self, data):
        all_data = json.loads(data)
        precessed_data = {}
        tweet = all_data["text"]
        precessed_data["text"] = tweet
        username = all_data["user"]["screen_name"]
        precessed_data["username"] = username
        tweet_id = all_data["id_str"]
        precessed_data["tweet_id"] = tweet_id
        create_time = all_data["created_at"]
        precessed_data["create_time"] = create_time

        try:
            if all_data["coordinates"] is not None:
                location = all_data["coordinates"]
                precessed_data["location"] = location
                print(precessed_data)
                docs = precessed_data
                db_with_location[tweet_id] = docs
                return True
            else:
                print(precessed_data)
                docs = precessed_data
                db_no_location[tweet_id] = docs
                return True
        except BaseException as e:
            print('failed ondata,', str(e))
            #time.sleep(5)
     
    def on_error(self, status):
        print(status)

auth = OAuthHandler(ckey, csecret)
auth.set_access_token(atoken, asecret)
twitterStream = Stream(auth, listener())
twitterStream.filter(locations=[150.239798, -34.282502, 151.407096, -33.367559], languages=["en"])


