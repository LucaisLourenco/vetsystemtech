import {BaseEntity} from "./base-entity.model";

export interface Tutor extends BaseEntity {
    name: string;
    username: string;
    cpf: string;
    gender_id: string;
    email: string;
    birth: string;
    password: string;
    active: string;
}
