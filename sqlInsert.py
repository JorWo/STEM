import MySQLdb

db = MySQLdb.connect(host="localhost", user="jorwon21", passwd="wong", db="jorwon21")
#Create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)
db.autocommit(True)

#Create table as per requirement
sql = "INSERT INTO students (name, age, gradeLevel) VALUES ('Joe', '17', '12')"

cur.execute(sql)

#Disconnect from server
cur.close()
db.close()
