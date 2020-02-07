import MySQLdb

db = MySQLdb.connect(host="localhost", user="user", passwd="password", db="school")
#Create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)
db.autocommit(True)

#SQL insert statement
sql = "INSERT INTO students (name, age, gradeLevel) VALUES ('Joe', '17', '12')"

cur.execute(sql)

#Disconnect from server
cur.close()
db.close()
