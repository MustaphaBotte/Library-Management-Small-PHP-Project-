select books.* ,authors.firstname,categoryname from books
inner join authors on books.authorid = authors.authorid
inner join categories on categories.CategoryId = books.CategoryId
limit 1;


SELECT books.*,FirstName,LastName,CategoryName from books 
   inner join authors on books.authorid = authors.authorid
   inner join categories on categories.CategoryId = books.CategoryId  
   
   select * from bookscopies
   SELECT *  from authors 
        INNER JOIN countries on nationalityid= countries.countryid