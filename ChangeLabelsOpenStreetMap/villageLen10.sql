SELECT       DISTINCT  Name, OCode
FROM            village
WHERE        (LEN(Name) < 10)
ORDER BY OCode