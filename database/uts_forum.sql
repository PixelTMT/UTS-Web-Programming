use uts_forum;


CREATE TABLE user (
  id VARCHAR(5) PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  email VARCHAR(45) NOT NULL,
  user_key VARCHAR(30) NOT NULL,
  encrypted_password VARCHAR(50) NOT NULL,
  img VARCHAR(50),
  roles smallint(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE forum (
  id VARCHAR(5) PRIMARY KEY,
  categories VARCHAR(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE post (
  id VARCHAR(5) NOT NULL PRIMARY KEY,
  title VARCHAR(300) NOT NULL,
  body VARCHAR(99999) NOT NULL,
  like_ammount INT NOT NULL,
  comment_ammount INT NOT NULL,
  time_created TIME NOT NULL,
  date_created DATE NOT NULL,
  user_id VARCHAR(5) NOT NULL,
  forum_id VARCHAR(5) NOT NULL,
  FOREIGN KEY(user_id) REFERENCES user(id),
  FOREIGN KEY(forum_id) REFERENCES forum(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comment (
  user_id VARCHAR(5),
  post_id VARCHAR(5),
  body    VARCHAR(5000) NOT NULL,
  time_created TIME NOT NULL,
  date_created DATE NOT NULL,
  PRIMARY KEY(user_id, post_id),
  FOREIGN KEY(user_id) REFERENCES user(id),
  FOREIGN KEY(post_id) REFERENCES post(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;