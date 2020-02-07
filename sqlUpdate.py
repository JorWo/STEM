import MySQLdb

db = MySQLdb.connect(host="localhost", user="user", passwd="password", db="school")
#create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)

#SQL update statement
sql = "UPDATE students SET age=16 WHERE name='Joe' "

cur.execute(sql)
	
#disconnect from server
db.close()
