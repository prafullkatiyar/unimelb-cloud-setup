# Twitter-harvesters
This is a cloud-based Twitter harvesters application, which is used for the assignment 2 for subject Cloud computing.

Twitter_Spider.py:
This file is for getting tweets data (very current data) from Melbourne by stream API. The data gotten then is stored in couchdb on the Nectar, which is separately into two databases according to the condition whether they contain the coordinates information.
  
Twitter_Spider_Sydney.py:
This file is for getting tweets data (very current data) from Sydney by stream API. The data gotten then is stored in   couchdb on the Nectar, which is separately into two databases according to the condition whether they contain the coordinates information.
 
Twitter_Spider_Search_Mel.py:
This file is for getting tweets data (the history data) from Melbourne by search API. The data gotten then is stored in couchdb on the Nectar, which is separately into two databases according to the condition whether they contain the coordinates information.
 
Twitter_Spider_Search_Sydney.py:
This file is for getting tweets data (the history data) from Sydney by search API. The data gotten then is stored in couchdb on the Nectar, which is separately into two databases according to the condition whether they contain the coordinates information.
