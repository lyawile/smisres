SELECT 
    studId,  concat(s.firstname,' ', s.surname) as studNames,
    MAX(CASE
        WHEN
            subjectID = 1
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 1 AND studId = 4)
        ELSE NULL
    END) AS 'Chemistry',
    MAX(CASE
        WHEN
            subjectID = 2
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 2 AND studId = 4)
        ELSE NULL
    END) AS 'Mathematics',
    MAX(CASE
        WHEN
            subjectID = 3
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 3 AND studId = 4)
        ELSE NULL
    END) AS 'Physics',
    MAX(CASE
        WHEN
            subjectID = 4
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 4 AND studId = 4)
        ELSE NULL
    END) AS 'Civics',
    MAX(CASE
        WHEN
            subjectID = 5
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 5 AND studId = 4)
        ELSE NULL
    END) AS 'Geography',
    MAX(CASE
        WHEN
            subjectID = 6
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 6 AND studId = 4)
        ELSE NULL
    END) AS 'Islamic knowledge',
    MAX(CASE
        WHEN
            subjectID = 7
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 7 AND studId = 4)
        ELSE NULL
    END) AS 'Quran',
    MAX(CASE
        WHEN
            subjectID = 8
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 9 AND studId = 4)
        ELSE NULL
    END) AS 'Kiswahili',
    MAX(CASE
        WHEN
            subjectID = 9
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 9 AND studId = 4)
        ELSE NULL
    END) AS 'English',
    MAX(CASE
        WHEN
            subjectID = 10
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 10 AND studId = 4)
        ELSE NULL
    END) AS 'Biology',
    MAX(CASE
        WHEN
            subjectID = 11
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 11 AND studId = 4)
        ELSE NULL
    END) AS 'Arabic knowledge',
    MAX(CASE
        WHEN
            subjectID = 12
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 12 AND studId = 4)
        ELSE NULL
    END) AS 'History',
    MAX(CASE
        WHEN
            subjectID = 13
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 13 AND studId = 4)
        ELSE NULL
    END) AS 'Commerce',
    MAX(CASE
        WHEN
            subjectID = 14
        THEN
            (SELECT 
                    avgJune
                FROM
                    mtiss_db.score
                WHERE
                    subjectID = 14 AND studId = 4)
        ELSE NULL
    END) AS 'Book keeping'
FROM
    mtiss_db.score inner join student s ON s.id = score.studId
WHERE
    studId = 4
GROUP BY studId;