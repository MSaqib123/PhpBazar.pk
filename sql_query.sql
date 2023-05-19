--_________ Category ______
create table category(
	catId int primary key AUTO_INCREMENT,
    Name varchar(25),
    description varchar(25),
    imgUrl varchar(500)
);
insert INTO category values (null, 'Shirts', 'The best shirt in the word','imageURl')


--_________ Color ______
create table color(
    colorId int primary key AUTO_INCREMENT,
	Name varchar(25)
)

insert into color values (null,'Red');
insert into color values (null,'Green');
insert into color values (null,'Yellow');



--_________ Product ______

create table product(
pId int primary key AUTO_INCREMENT,
Name varchar(25),
shortDesc varchar(100),
longDesc varchar(1000),
imgUrl varchar(250),
Price int,
catId int,
colorId int, 
 foreign key (catId) REFERENCES category(catId),
 foreign key (colorId) REFERENCES color(colorId),
    Status bit
)


select * from product INNER JOIN category on product.catId = category.catId inner join 
color on product.colorid = color.colorid

                   
select * from category;
select * from color;

insert into product values (null,'BataShoes','i love Shoes','skdfksd fsdkfsdf sdf sd fsdf','sdfsd',4000,20,17,0)


create table users(
	uId int primary key AUTO_INCREMENT,
	uName varchar(25),
   	uEmail varchar(50),
    uPassword varchar(50),
    uPhone varchar(15),
    uGender bit,
    uImageUrl varchar(25)
)