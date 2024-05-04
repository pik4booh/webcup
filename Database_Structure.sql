USE superdevy_power_switch;


CREATE  TABLE power_switch_element ( 
	power_switch_element_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	power_switch_element_name VARCHAR(20)    NOT NULL   
 ) engine=InnoDB;
 insert into power_switch_element values(null, "Feu");
 insert into power_switch_element values(null, "Eau");
 insert into power_switch_element values(null, "Vent");
 insert into power_switch_element values(null, "Terre");
 insert into power_switch_element values(null, "Lumière");
 insert into power_switch_element values(null, "Ténèbres");


CREATE  TABLE power_switch_rarity ( 
	power_switch_rarity_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	power_switch_rarity_name VARCHAR(20)    NOT NULL   
 ) engine=InnoDB;
 insert into power_switch_rarity values(null, "Commun");
 insert into power_switch_rarity values(null, "Rare");
 insert into power_switch_rarity values(null, "Magique");
 insert into power_switch_rarity values(null, "Epique");
 insert into power_switch_rarity values(null, "Légendaire");


CREATE  TABLE power_switch_type ( 
	power_switch_type_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	power_switch_type_name VARCHAR(20)    NOT NULL   
 ) engine=InnoDB;
 insert into power_switch_type values(null, "Mêlée");
 insert into power_switch_type values(null, "Distance");


CREATE TABLE power_switch_gender (
    power_switch_gender_id INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    power_switch_gender_name CHAR(1)    NOT NULL
) engine=InnoDB;
insert into power_switch_gender values(null, 'M');
insert into power_switch_gender values(null, 'F');


CREATE  TABLE power_switch_user ( 
	power_switch_user_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	power_switch_user_first_name VARCHAR(100)    NOT NULL   ,
	power_switch_user_last_name VARCHAR(100)    NOT NULL   ,
	power_switch_user_gender_id INT    NOT NULL   ,
	power_switch_user_email VARCHAR(50)    NOT NULL   ,
	power_switch_user_password VARCHAR(100)    NOT NULL   ,
	power_switch_user_nickname VARCHAR(20)    NOT NULL   ,
    CONSTRAINT fk_power_switch_user_with_gender FOREIGN KEY ( power_switch_user_gender_id ) REFERENCES power_switch_gender( power_switch_gender_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;


CREATE  TABLE power_switch_chat (
	power_switch_chat_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	power_switch_chat_sender_id INT    NOT NULL   ,
	power_switch_chat_message text,
	power_switch_chat_sending_datetime DATETIME    NOT NULL   ,
	power_switch_chat_receiver_id INT    NOT NULL   ,
	power_switch_chat_receiving_datetime DATETIME    NOT NULL   ,
	CONSTRAINT fk_power_switch_chat FOREIGN KEY ( power_switch_chat_sender_id ) REFERENCES power_switch_user( power_switch_user_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_power_switch_chat_receiver FOREIGN KEY ( power_switch_chat_receiver_id ) REFERENCES power_switch_user( power_switch_user_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;


CREATE  TABLE power_switch_superpower ( 
	power_switch_superpower_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	power_switch_superpower_name VARCHAR(100)    NOT NULL   ,
	power_switch_superpower_damage DOUBLE    NOT NULL   ,
	power_switch_superpower_accuracy DOUBLE    NOT NULL   ,
	power_switch_superpower_mana_cost INT    NOT NULL   ,
	power_switch_superpower_effect VARCHAR(255)    NOT NULL   ,
	power_switch_element_id INT    NOT NULL   ,
	power_switch_type_id INT    NOT NULL   ,
	power_switch_rarity_id INT    NOT NULL   ,
	CONSTRAINT fk_power_switch_superpower FOREIGN KEY ( power_switch_element_id ) REFERENCES power_switch_element( power_switch_element_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_power_switch_superpower_with_type FOREIGN KEY ( power_switch_type_id ) REFERENCES power_switch_type( power_switch_type_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_power_switch_superpower_with_rarity FOREIGN KEY ( power_switch_rarity_id ) REFERENCES power_switch_rarity( power_switch_rarity_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;
 insert into power_switch_superpower values(null, "Boule de feu", 50, 100, 20, "Pas d'effet spécial", 1, 1, 1);
 insert into power_switch_superpower values(null, "Double Boule de feu", 100, 100, 30, "Frappe l'enemi 2 fois et inflige 20% de dégâts en plus.", 1, 1, 2);
 insert into power_switch_superpower values(null, "Brasier", 150, 80, 30, "Brûle l'enemi de 100% de la somme de ses sorts Feu.", 1, 2, 3);
 insert into power_switch_superpower values(null, "Eruption", 200, 75, 50, "Inflige obligatoirement 100% de ses dégâts à la cible. 1 fois tous les deux tours.", 1, 2, 4);
 insert into power_switch_superpower values(null, "Météor Enflammé", 300, 50, 100, "Enlève la brûlure et la converti en dégâts fixe. Frappe deux fois avec un critique.", 1, 1, 5);

 insert into power_switch_superpower values(null, "Splash", 50, 100, 20, "Pas d'effet spécial", 2, 2, 1);
 insert into power_switch_superpower values(null, "Canon Aqua", 100, 100, 30, "Mouliie d'abord la cible, puis inflige 50% de dégâts en plus pour tout état sur l'adversaire.", 2, 2, 2);
 insert into power_switch_superpower values(null, "Marée Haute", 150, 75, 30, "Inflige 300% de dégâts avec un critique. Ajoute 1% pour chaque état sur l'adversaire.", 2, 2, 3);
 insert into power_switch_superpower values(null, "Tsunami", 200, 85, 50, "Rase le terrain et converti tous vos sorts par des sorts Eau.", 2, 2, 4);
 insert into power_switch_superpower values(null, "Déluge", 300, 50, 100, "Avec un critique et exactement 10 état sur l'adversaire, met fin à la partie.", 2, 2, 5);

 insert into power_switch_superpower values(null, "Cyclone", 50, 100, 20, "Pas d'effet spécial", 3, 2, 1);
 insert into power_switch_superpower values(null, "Ouragan", 100, 95, 30, "Pas d'effet spécial", 3, 2, 2);
 insert into power_switch_superpower values(null, "Triple Cyclone", 150, 100, 30, "Avec un critique, pioche 'Cyclone' et 'Ouragan' dans vos sorts actifs.", 3, 2, 3);
 insert into power_switch_superpower values(null, "Jet Stream", 200, 90, 50, "Etourdis l'adversaire. Inflige 100% de dégâts en plus si l'adversaire est déjà étourdi.", 3, 1, 4);
 insert into power_switch_superpower values(null, "Vent Mystique", 300, 30, 100, "", 3, 2, 5);

 insert into power_switch_superpower values(null, "Eboulement", 50, 95, 20, "Pas d'effet spécial", 4, 1, 1);
 insert into power_switch_superpower values(null, "Séisme", 100, 100, 30, "Pas d'effet spécial", 4, 1, 2);
 insert into power_switch_superpower values(null, "Abîme", 150, 100, 30, "Bloque l'adversaire pendant 3 tours.", 4, 1, 3);
 insert into power_switch_superpower values(null, "Canon de Pierre", 200, 100,50, "Avec un critique, ce sort a 30% de chance d'étourdir et de baisser la défense adverse.", 4, 2, 4);
 insert into power_switch_superpower values(null, "Pluie de Météor", 300, 45, 100, "Frappe 5 fois. Vous avex 20% de chance de piocher un sort Météor de votre choix.", 4, 2, 5);

 insert into power_switch_superpower values(null, "Lumière Divine", 100, 100, 20, "Soigne la cible de 50% de ses points de vie.", 5, 2, 3);
 insert into power_switch_superpower values(null, "Halo de Lumière", 100, 100, 30, "Augmente l'attaque de la cible de 50% pour chaque tranche de point de vie dépassant 1000.", 5, 2, 3);
 insert into power_switch_superpower values(null, "Bénédiction", 150, 100, 30, "Applique un bouclier pendant 3 tour. Ne résisite pas aux états.", 5, 2, 4);
 insert into power_switch_superpower values(null, "Descente du Roi", 200, 100, 50, "Utilisable 1 fois par match. Rase le terrain et augmente votre attaque par la somme des cibles +1000", 5, 1, 4);
 insert into power_switch_superpower values(null, "Jugement Dernier", 500, 95, 100, "Si il ne vous reste que ce sort avec des points de vie égaux à 300, met fin à la partie.", 5, 1, 5);

 insert into power_switch_superpower values(null, "Ombre Magique", 150, 100, 20, "Frappe en premier. Applique un DOT qui inflige 2% de la vie de la cible par tour.", 6, 2, 3);
 insert into power_switch_superpower values(null, "Griffes du Fléau", 200, 100, 30, "50% de chance de baisser la défense. 30% de chances de doubler l'attaque de l'utilisateur.", 6, 1, 3);
 insert into power_switch_superpower values(null, "Malédiction", 200, 100, 30, "Baisse la défense de la cible à 0. Augmente son attauqe par 6.", 6, 1,4 );
 insert into power_switch_superpower values(null, "Ascension du Fléau", 300, 100, 50, "Raze votre terrain et applique 6 DOT à chaque enemi. Les DOT peuvent critique.", 6, 1, 4);
 insert into power_switch_superpower values(null, "Extermination", 600, 50, 100, "Met vos points de vie à 0. Votre attaque augmente de 50 et vous avez la main.", 6, 1, 5);


CREATE TABLE power_switch_transaction ( 
	power_switch_transaction_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	power_switch_seller_id INT    NOT NULL   ,
	power_switch_selled_superpower INT    NOT NULL   ,
	power_switch_buyer_id INT       ,
	power_switch_transaction_superpower INT       ,
	power_switch_ask_transaction_datetime DATETIME    NOT NULL   ,
	power_switch_confirm_transaction_datetime      DATETIME  ,
	power_switch_reject_transaction_datetime     DATETIME   ,
	CONSTRAINT fk_power_switch_transaction_for_seller FOREIGN KEY ( power_switch_seller_id ) REFERENCES power_switch_user( power_switch_user_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_power_switch_transaction_for_buyer FOREIGN KEY ( power_switch_buyer_id ) REFERENCES power_switch_user( power_switch_user_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_power_switch_transaction_with_superpower FOREIGN KEY ( power_switch_transaction_superpower ) REFERENCES power_switch_superpower( power_switch_superpower_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_power_switch_transaction_with_superpower_2 FOREIGN KEY ( power_switch_selled_superpower ) REFERENCES power_switch_superpower( power_switch_superpower_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE table power_switch_user_superpowers(
	power_switch_user_superpowers_id int not null auto_increment PRIMARY KEY,
	power_switch_user_id int not null,
	power_switch_superpower_id int not null,
	power_switch_user_superpower_acquisition_datetime DATETIME not null,
	CONSTRAINT fk_power_switch_user_superpower_for_user foreign key (power_switch_user_id) REFERENCES power_switch_user(power_switch_user_id),
	CONSTRAINT fk_power_switch_user_superpower_for_superpower foreign key (power_switch_superpower_id) REFERENCES power_switch_superpower(power_switch_superpower_id)
);
create or replace view listpouvoir as select power_switch_superpower.*,
(select power_switch_type_name from power_switch_type where power_switch_type.power_switch_type_id=power_switch_superpower.power_switch_type_id) as typesp,
(select power_switch_element_name from power_switch_element where power_switch_element.power_switch_element_id=power_switch_superpower.power_switch_element_id) as elementsp,
(select power_switch_rarity_name from power_switch_rarity where power_switch_rarity.power_switch_rarity_id=power_switch_superpower.power_switch_rarity_id) as raritysp
from power_switch_superpower 
;
create or replace view listtransaction as select power_switch_transaction.*,
(select power_switch_user_nickname from power_switch_user where power_switch_user.power_switch_user_id=power_switch_transaction.power_switch_seller_id) as nomSeller,
(select power_switch_superpower_name from power_switch_superpower where power_switch_superpower.power_switch_superpower_id=power_switch_transaction.power_switch_selled_superpower) as sp1,
(select power_switch_user_nickname from power_switch_user where power_switch_user.power_switch_user_id=power_switch_transaction.power_switch_buyer_id) as nomBuyer,
(select power_switch_superpower_name from power_switch_superpower where power_switch_superpower.power_switch_superpower_id=power_switch_transaction.power_switch_transaction_superpower) as sp2
from power_switch_transaction;
;

select * from power_switch_superpower where power_switch_superpower_id in (select power_switch_buyer_id from power_switch_transaction where count(power_switch_)=power_switch_)
select * from listpouvoir where power_switch_superpower_id not in (select power_switch_superpower_id from power_switch_user_superpowers where )
select * from power_switch_superpower;
