drop table if exists tbl_book_reader_xref;
drop table if exists tbl_book_author_xref;
drop table if exists tbl_reader;
drop table if exists tbl_author;
drop table if exists tbl_book;


create table tbl_book
(
id integer not null primary key auto_increment,
name varchar(200),
create_time timestamp,
update_time timestamp
);


create table tbl_author
(
id integer not null primary key auto_increment,
name varchar(200),
create_time timestamp,
update_time timestamp
);


create table tbl_reader
(
id integer not null primary key auto_increment,
name varchar(200),
create_time timestamp,
update_time timestamp
);

create table tbl_book_author_xref
(
book_id integer not null,
author_id integer not null,
foreign key (book_id) references tbl_book (id),
foreign key (author_id) references tbl_author (id),
primary key (book_id, author_id)
);

create table tbl_book_reader_xref
(
book_id integer not null,
reader_id integer not null,
foreign key (book_id) references tbl_book (id),
foreign key (reader_id) references tbl_reader (id),
primary key (book_id, reader_id)
);


