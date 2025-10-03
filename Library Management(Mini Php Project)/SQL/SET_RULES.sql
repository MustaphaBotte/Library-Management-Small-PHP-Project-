alter table Books
add foreign key (CategoryId) references Categories(CategoryId)
on delete set null;

alter table Books
add foreign key (AuthorId) references Authors(AuthorId)
on delete set null;


alter table authors
add  foreign key (NationalityId) references countries(countryid)
on delete set null;


alter table admins
add  foreign key (NationalityId) references countries(countryid)
on delete set null;

alter table admins
add  foreign key (createdby) references admins(adminid)
on delete restrict;

alter table users
add  foreign key (NationalityId) references countries(countryid)
on delete set null;

alter table users
add  foreign key (createdby) references admins(adminid)
on delete restrict on update restrict;

alter table Appointments
add  foreign key (createdby) references admins(adminid)
on delete restrict on update restrict;

alter table Appointments
add  foreign key (userid) references users(userid)
on delete no action;

alter table Bookscopies
add foreign key (bookid) references books(bookid)
on delete cascade


alter table Bookscopies
drop constraint `bookscopies_ibfk_1`

