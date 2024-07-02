CREATE DATABASE `Cipher`;
USE `Cipher`;
CREATE TABLE User (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Email VARCHAR(100) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    DateJoined TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Reputation INT DEFAULT 0,
    ProfilePicture VARCHAR(255)
);

CREATE TABLE Question (
    QuestionID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    Title VARCHAR(255) NOT NULL,
    Body TEXT NOT NULL,
    DatePosted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ViewCount INT DEFAULT 0,
    Upvotes INT DEFAULT 0,
    Downvotes INT DEFAULT 0,
    -- Removed AcceptedAnswerID to avoid cyclic dependency
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Answer (
    AnswerID INT PRIMARY KEY AUTO_INCREMENT,
    QuestionID INT,
    UserID INT,
    Body TEXT NOT NULL,
    DatePosted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Upvotes INT DEFAULT 0,
    Downvotes INT DEFAULT 0,
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

-- Adding the AcceptedAnswerID column and foreign key after Answer table is created
ALTER TABLE Question
ADD AcceptedAnswerID INT,
ADD FOREIGN KEY (AcceptedAnswerID) REFERENCES Answer(AnswerID);

CREATE TABLE Comment (
    CommentID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    QuestionID INT,
    AnswerID INT,
    Body TEXT NOT NULL,
    DatePosted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID),
    FOREIGN KEY (AnswerID) REFERENCES Answer(AnswerID)
);

CREATE TABLE Tag (
    TagID INT PRIMARY KEY AUTO_INCREMENT,
    TagName VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE QuestionTag (
    QuestionID INT,
    TagID INT,
    PRIMARY KEY (QuestionID, TagID),
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID),
    FOREIGN KEY (TagID) REFERENCES Tag(TagID)
);

CREATE TABLE Vote (
    VoteID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    QuestionID INT,
    AnswerID INT,
    VoteType ENUM('Upvote', 'Downvote') NOT NULL,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID),
    FOREIGN KEY (AnswerID) REFERENCES Answer(AnswerID)
);
