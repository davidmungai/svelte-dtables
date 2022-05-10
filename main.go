package main

import (
	"database/sql"
	"fmt"
	"io/ioutil"
	"os"
	"sendMails/utils"
	"sync"

	"github.com/joho/godotenv"
	_ "github.com/lib/pq"
)

func init() {
	err := godotenv.Load()
	if err != nil {
		panic(err)
	}
}

type Member struct {
	count     int
	allnames  string
	e_mail    string
	member_no string
}

func readQuery() string {

	data, err := ioutil.ReadFile("query.txt")
	if err != nil {
		fmt.Println("File reading error")
		panic(err)

	}
	return string(data)
}

func main() {
	var members []Member
	sqlQuery := readQuery()
	host := os.Getenv("DB_HOST")
	port := 5432
	user := os.Getenv("DB_USERNAME")
	password := os.Getenv("DB_PASSWORD")
	dbname := os.Getenv("DB_DATABASE")
	// tempName := os.Getenv("templateName")
	psqlInfo := fmt.Sprintf("host=%s port=%d user=%s "+
		"password=%s dbname=%s sslmode=disable",
		host, port, user, password, dbname)
	db, err := sql.Open("postgres", psqlInfo)
	if err != nil {
		panic(err)
	}

	db.Exec("set search_path to unitmaster")
	defer db.Close()

	err = db.Ping()
	if err != nil {
		panic(err)
	}
	fmt.Println(sqlQuery)
	rows, err := db.Query(sqlQuery)

	if err != nil {
		// handle this error better than this
		panic(err)
	}

	defer rows.Close()

	for rows.Next() {
		var member Member
		err = rows.Scan(&member.allnames, &member.e_mail, &member.member_no)
		if err != nil {
			// handle this error
			panic(err)
		}
		members = append(members, member)

		//

	}
	var waitgroup sync.WaitGroup
	waitgroup.Add(len(members))
	for index, singleMember := range members {
		fmt.Println(index)
		go func(member Member) {
			utils.SendMail(singleMember.e_mail, "AGM Meeting", utils.PrepareTemplate("message", singleMember))
			waitgroup.Done()
		}(singleMember)
	}

	waitgroup.Wait()

	// get any error encountered during iteration
	err = rows.Err()
	if err != nil {
		panic(err)
	}

	fmt.Println("Successfully connected!")
}

func myFunc(waitgroup *sync.WaitGroup) {
	defer waitgroup.Done()
	fmt.Println("Inside my goroutine")

}
