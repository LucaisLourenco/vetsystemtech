import {Component, OnInit} from '@angular/core';
import {PaginationBaseService} from "./pagination-base.service";

@Component({
  selector: 'app-pagination-base',
  templateUrl: './pagination-base.component.html',
  styleUrls: ['./pagination-base.component.scss']
})
export abstract class PaginationBaseComponent<T> implements OnInit {
  items: T[] = [];
  currentPage = 1;
  totalPage = 1;

  protected constructor(private paginationService: PaginationBaseService<T>) {
  }

  ngOnInit(): void {
    this.loadItems();
  }

  loadItems(page = 1): void {
    this.paginationService.getItems(page).subscribe(response => {
      this.items = response.data;
      this.currentPage = response.current_page;
      this.totalPage = response.last_page;
    });
  }
}
