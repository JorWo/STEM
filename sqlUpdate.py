import MySQLdb

db = MySQLdb.connect(host="localhost", user="api", passwd="f103", db="people")
#create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)

#Create table as per requirement
sql = "UPDATE students SET age=16 WHERE name='Joe' "

cur.execute(sql)
	
#disconnect from server
db.close()
