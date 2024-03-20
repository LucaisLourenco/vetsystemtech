import {Component, OnInit} from '@angular/core';

abstract class PaginationComponent implements OnInit {
  data: any;
  page: number = 1;
  limit: number = 10;

  ngOnInit() {
    this.getData();
  }

  abstract getData(): void;

  firstPage() {
    this.page = 1;
    this.getData();
  }

  previousPage() {
    if (this.page > 1) {
      this.page--;
      this.getData();
    }
  }

  nextPage() {
    this.page++;
    this.getData();
  }

  lastPage() {
    this.page = this.data.totalPages;
    this.getData();
  }

}
