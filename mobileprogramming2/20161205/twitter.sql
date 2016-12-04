/*----------------------------------------
 * CREATE DATABASE
 *----------------------------------------*/
CREATE DATABASE twitter;
USE twitter;

/*----------------------------------------
 * CREATE TABLE
 *----------------------------------------*/
/**
 * User Table
 */
CREATE TABLE User(
    uid           int,
    name          varchar(15)  NOT NULL,    /* NULL禁止 */
    displayname   varchar(60),
    register_date datetime,

    PRIMARY KEY(uid)
);

/**
 * Tweets Table
 */
CREATE TABLE Tweets(
    tid           int,
    uid           int            NOT NULL,   /* NULL禁止 */
    tweet         varchar(255)   NOT NULL,   /* NULL禁止 */
    fav           int            DEFAULT 0,  /* INSERT時に指定がない場合は0 */
    rt            int            DEFAULT 0,  /* INSERT時に指定がない場合は0 */
    register_date datetime,

    PRIMARY KEY(tid)
);



/*----------------------------------------
 * INSERT
 *----------------------------------------*/
/**
 * User
 */
INSERT INTO User(uid, name, displayname, register_date)
VALUES (1, 'FFXVJP', 'FINAL FANTASY XV', '2010-01-01 00:00:00'),
       (2, 'DQ',     'DRAGON QUEST',     '2015-01-01 00:00:00');

/**
 * Tweets
 */
INSERT INTO Tweets(tid, uid, tweet, register_date)
VALUES (1234567891, 1, '11/29に発売されました！',                  now()),   /* now()は現在時刻を返す関数 */
       (1234567892, 1, '出荷本数が500万本を突破しました',            now()),
       (1234567893, 2, 'マックのハッピーセットでグッズがもらえるよ',    now());
