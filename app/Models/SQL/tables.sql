CREATE TABLE questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    tags VARCHAR(255),
    votes INT DEFAULT 0,
    postedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    username VARCHAR(255),
    FOREIGN KEY (username) REFERENCES users(username)
);


CREATE TABLE answers (
    answer_id INT AUTO_INCREMENT PRIMARY KEY,
    body TEXT NOT NULL,
    votes INT DEFAULT 0,
    postedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    isAccepted BOOLEAN DEFAULT FALSE,
    question_id INT,
    FOREIGN KEY (question_id) REFERENCES questions(question_id)
);

CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    body TEXT NOT NULL,
    postedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    answer_id INT,
    FOREIGN KEY (answer_id) REFERENCES answers(answer_id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100),
    username VARCHAR(50),
    password VARCHAR(100)
);

