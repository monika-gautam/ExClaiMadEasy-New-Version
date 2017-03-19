CREATE TABLE employee (id VARCHAR(7), name VARCHAR(50), acc VARCHAR(25), manager_name VARCHAR(50), exp_nature varchar(30), pmtdt varchar(20),status varchar(50),remarks varchar(200),bill_type varchar(10));
CREATE TABLE collectdata (id VARCHAR(7), submission_date VARCHAR(10), date VARCHAR(10), brdtm VARCHAR(7), amount double, rate double, bill_type varchar(10));
CREATE TABLE employee_info(emailid varchar(50),employee_id varchar(15),name varchar(50),passwd varchar(25));
CREATE TABLE manager_info(username VARCHAR(50),passwd VARCHAR(15),id VARCHAR(10),email VARCHAR(50),name VARCHAR(50));
