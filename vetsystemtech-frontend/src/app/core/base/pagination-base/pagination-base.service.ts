import {Injectable} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export abstract class PaginationBaseService<T> {

  protected abstract endpoint: string;

  protected constructor(protected http: HttpClient) {
  }

  getItems(page = 1, pageSize = 15): Observable<any> {
    return this.http.get(`${this.endpoint}?page=${page}&per_page=${pageSize}`);
  }
}
