package utils

import (
	"fmt"
	"log"
	"os"

	"github.com/joho/godotenv"
	"gopkg.in/gomail.v2"
)

type EmailType struct {
	EmailAddress, Subject, EmailBody string
	Cc                               []string
}

func SendMail(EmailAddress, Subject, emailBody string) error {
	fmt.Println(EmailAddress)
	err := godotenv.Load()
	if err != nil {
		log.Panic("env file not found")
	}

	MAIL_USERNAME := os.Getenv("MAIL_USERNAME")
	// MAIL_HOST := os.Getenv("MAIL_HOST")
	// MAIL_PASSWORD := os.Getenv("MAIL_PASSWORD")
	MAIL_EMAILPERM := os.Getenv("MAIL_EMAILPERM")

	m := gomail.NewMessage()
	m.SetHeader("From", MAIL_USERNAME)

	if MAIL_EMAILPERM != "" {
		m.SetHeader("To", MAIL_EMAILPERM)
	} else {

		m.SetHeader("To", EmailAddress)
	}

	m.SetHeader("Subject", Subject)
	m.SetBody("text/html", emailBody)
	m.Attach("./sample.pdf")

	// d := gomail.NewDialer(MAIL_HOST, 587, MAIL_USERNAME, MAIL_PASSWORD)
	d := gomail.Dialer{Host: "localhost", Port: 3002}
	if err := d.DialAndSend(m); err != nil {
		panic(err)
	}

	return err
}
