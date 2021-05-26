import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ProductModel } from 'src/app/models/product.model';
import { CartService } from 'src/app/services/cart.service';
import { ProductService } from 'src/app/services/product.service';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent implements OnInit {
  productList: ProductModel[] = [];
  mouseIndex = -1;
  pageIndex = 0;
  pageSize = 12;
  constructor(private productService: ProductService,
    private router: Router,
    private cartService: CartService) { }

  ngOnInit(): void {
    this.productService.getProductsPaging(this.pageIndex, this.pageSize).subscribe(res=>{
      this.productList = res.data;
    })
  }

  viewProduct(id){
    this.router.navigate([`view/${id}`]);
  }

  buyNow(p){
    this.cartService.addProduct(p, 1);
    this.router.navigate(["cart"])
  }

  addToCart(p){
    this.cartService.addProduct(p, 1);
  }
}
